<?php

namespace Solarium\QueryType\Select;

use Solarium\Core\Client\Request;
use Solarium\Core\Query\AbstractQuery;
use Solarium\Core\Query\AbstractRequestBuilder as BaseRequestBuilder;
use Solarium\Core\Query\QueryInterface;
use Solarium\QueryType\Select\Query\Query as SelectQuery;

/**
 * Build a select request.
 */
class RequestBuilder extends BaseRequestBuilder
{
    /**
     * Build request for a select query.
     *
     * @param QueryInterface|SelectQuery $query
     *
     * @return Request
     */
    public function build(AbstractQuery $query): Request
    {
        $request = parent::build($query);

        // add basic params to request
        $request->addParam(
            'q',
            sprintf('%s%s', $query->getLocalParameters()->render(), $query->getQuery())
        );
        $request->addParam('start', $query->getStart());
        $request->addParam('rows', $query->getRows());
        // APPBASE CHANGED
        // $request->addParam('fl', implode(',', $query->getFields()));
        $request->addParam('q.op', $query->getQueryDefaultOperator());
        $request->addParam('df', $query->getQueryDefaultField());
        $request->addParam('cursorMark', $query->getCursormark());
        $request->addParam('sow', $query->getSplitOnWhitespace());

        // add sort fields to request
        $sort = [];
        foreach ($query->getSorts() as $field => $order) {
            $sort[] = $field.' '.$order;
        }
        if (0 !== \count($sort)) {
            $request->addParam('sort', implode(',', $sort));
        }

        // add filterqueries to request
        // APPBASE CHANGED
        $field_map = array(
            "tm_X3b_" => "_t",
            "bs_" => "_b",
            "ds_" => "_dt",
            "ss_" => "_s",
            // TODO not known
            "is_" => "_l",
            "fs_" => "_f",
            "ps_" => "_d",
        );
        $filterQueries = $query->getFilterQueries();
        if (0 !== \count($filterQueries)) {
            foreach ($filterQueries as $filterQuery) {
                $query_tmp = $filterQuery->getOption('query');
               
                if (!empty($query_tmp)) {
                    $query_tmp = ltrim($query_tmp, "(");
                    $query_tmp = rtrim($query_tmp, ")");
                    $queries_list = explode(" ", $query_tmp);
                    $new_query = "";
                    foreach($queries_list as $q) {
                        $q_tmp = explode(':', $q, 2);
                        $field = $q_tmp[0];
                        $current_field_map = explode('_', $field)[0].'_';
                        $has_plus = $current_field_map[0] == '+';
                        
                        if ($has_plus) {
                            $current_field_map = ltrim($current_field_map, '+');
                        }
                        if (isset($field_map[$current_field_map])) {
                            $suffix = $field_map[$current_field_map];
                        }
                        $field = ($has_plus ? '+' : '').explode('_', $field, 2)[1].$suffix;
                        $new_query = $new_query.$field.":".(ltrim($field, '+') == 'type_s' ? '"node--': '"').trim($q_tmp[1], '"').'" ';
                    }
                    
                    $new_query = "(".trim($new_query).")";
                    $filterQuery->setQuery($new_query);
                   
                    $fq = sprintf('%s%s', $filterQuery->getLocalParameters()->render(), $filterQuery->getQuery());

                    $request->addParam('fq', $fq);
                }
            }
        }

        // add components to request
        foreach ($query->getComponents() as $component) {
            $componentBuilder = $component->getRequestBuilder();
            if ($componentBuilder) {
                $request = $componentBuilder->buildComponent($component, $request);
            }
        }
        // dump($request);
        return $request;
    }
}
