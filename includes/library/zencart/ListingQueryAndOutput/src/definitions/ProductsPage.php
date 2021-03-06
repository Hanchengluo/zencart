<?php
/**
 * Class ProductsPage
 *
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: currencies.php 15880 2010-04-11 16:24:30Z wilt $
 */
namespace ZenCart\ListingQueryAndOutput\definitions;

/**
 * Class ProductsPage
 * @package ZenCart\ListingQueryAndOutput\definitions
 */
class ProductsPage extends AbstractDefinition
{
    /**
     *
     */
    public function initQueryAndOutput()
    {
        $this->listingQuery = array(
            'mainTable' => array(
                'table' => TABLE_PRODUCTS,
                'fkeyFieldLeft' => 'products_id',
            ),
            'isRandom' => false,
            'isPaginated' => true,
            'pagination' => array('adapterParams' => array('itemsPerPage' => MAX_DISPLAY_PRODUCTS_LISTING)),
            'filters' => array(
                array(
                    'name' => 'AlphaFilter',
                    'parameters' => array()
                ),
                array(
                    'name' => 'TypeFilter',
                    'parameters' => array('currentCategoryId' => $GLOBALS['current_category_id'])
                )
            ),
            'derivedItems' => array(
                array(
                    'field' => 'productCpath',
                    'handler' => 'productCpathBuilder'
                ),
                array( // must happen after productCpathBuilder
                    'field' => 'link',
                    'handler' => 'productLinkBuilder'
                ),
                array( // must happen after productLinkBuilder
                    'field' => 'displayPrice',
                    'handler' => 'displayPriceBuilder'
                ),
                array( // must happen after displayPriceBuilder
                    'field' => 'displayFreeTag',
                    'handler' => 'displayFreeTagBuilder'
                ),
                array( // must happen after displayPriceBuilder
                    'field' => 'priceBlock',
                    'handler' => 'priceBlockBuilder'
                ),
            ),
            'joinTables' => array(
                'TABLE_PRODUCTS_DESCRIPTION' => array(
                    'table' => TABLE_PRODUCTS_DESCRIPTION,
                    'type' => 'left',
                    'fkeyFieldLeft' => 'products_id',
                    'addColumns' => true
                )
            ),
            'whereClauses' => array(
                array(
                    'table' => TABLE_PRODUCTS_DESCRIPTION,
                    'field' => 'language_id',
                    'value' => $this->request->getSession()->get('languages_id'),
                    'type' => 'AND'
                ),
                array(
                    'table' => TABLE_PRODUCTS,
                    'field' => 'products_status',
                    'value' => 1,
                    'type' => 'AND'
                )
            )
        );
        $this->outputLayout = array(
            'formatter' => array('class' => 'TabularProduct',
                                 'template' => 'tpl_listingbox_tabular.php',
            ),
        );
    }
}
