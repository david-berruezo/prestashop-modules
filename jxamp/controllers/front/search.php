<?php
/**
 * 2017-2018 Zemez
 *
 * JX Accelerated Mobile Page
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the General Public License (GPL 2.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/GPL-2.0
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the module to newer
 * versions in the future.
 *
 *  @author    Zemez (Alexander Grosul)
 *  @copyright 2017-2018 Zemez
 *  @license   http://opensource.org/licenses/GPL-2.0 General Public License (GPL 2.0)
 */

use PrestaShop\PrestaShop\Adapter\Search\SearchProductSearchProvider;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class JxAmpSearchModuleFrontController extends AMPFrontControllerCore
{
    public $query;
    public function __construct($pageName, $templateName)
    {
        $pageName = 'search';
        $templateName = $pageName;
        if (Tools::getValue('s')) {
            $this->query = Tools::getValue('s');
            $this->parameters = array('s' => $this->query);
        }
        parent::__construct($pageName, $templateName);
        if (Tools::getValue('page')) {
            $this->page = Tools::getValue('page');
        }
        if (Tools::getValue('orderWay') && Tools::getValue('orderWay') != 'null') {
            $this->sortWay = Tools::getValue('orderWay');
        }
        if (Tools::getValue('orderBy') && Tools::getValue('orderBy') != 'null') {
            $this->sortBy = Tools::getValue('orderBy');
        }
    }

    public function getProducts()
    {
        $searchProvider = new SearchProductSearchProvider(
            $this->context->getTranslator()
        );

        $context = new ProductSearchContext($this->context);

        $query = new ProductSearchQuery();
        $query
            ->setSearchString($this->query)
            ->setPage($this->page)
            ->setResultsPerPage($this->resultPerPage)
            ->setSortOrder(new SortOrder('product', $this->sortBy, $this->sortWay));

        $this->products = $searchProvider->runQuery(
            $context,
            $query
        );

        return parent::getProducts();
    }

    public function initContent()
    {
        $link = new Link();
        $this->context->smarty->assign('amp_canonical', $link->getPageLink($this->pageName));
        $this->context->smarty->assign('jxamp_query', $this->query);
        $this->context->smarty->assign('products', $this->getProducts());
        if (Tools::getIsset('ajax')) {
            parent::setHeaders();
            die(json_encode(array('items'=> $this->getProducts())));
        }
        parent::initContent();
    }
}
