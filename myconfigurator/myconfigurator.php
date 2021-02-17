<?php
/**
* 2007-2021 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Myconfigurator extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'myconfigurator';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'David Berruezo';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;
		parent::__construct();

		$this->displayName = $this->l('My Configurator');
        $this->description = $this->l('Module to setup configurator');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('MYCONFIGURATOR_LIVE_MODE', false);

		// Preset configuration values
        Configuration::updateValue('MY_CONFIGURATION_VARIABLE', 'Nombre');
        Configuration::updateValue('MY_CONFIGURATION_VALUE', 'Variable');

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayAfterBodyOpeningTag') &&
            //$this->registerHook('displayMyCustomBanner')&&
            //$this->registerHook('displayMyCustomReaseguros') &&
            $this->registerHook('displayMyCustomPromociones') &&
            $this->registerHook('displayMyCustomNewArrivals') &&
            $this->registerHook('displayMyCustomPromocionUnica') &&
            $this->registerHook('displayMyCustomMejoresVentas') &&
            $this->registerHook('displayMyCustomPromocionesSegundas') &&
            $this->registerHook('displayMyCustomBlog') &&
            $this->registerHook('displayMyCustomPromocionesTerceras') &&
            $this->registerHook('displayMyModals');
            //$this->registerHook('displayMyCustomFooterOne') &&
            //$this->registerHook('displayMyCustomFooterTwo') &&

    }


    public function uninstall()
    {
        Configuration::deleteByName('MYCONFIGURATOR_LIVE_MODE');

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitMyconfiguratorModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output.$this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitMyconfiguratorModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }


    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'MYCONFIGURATOR_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'MYCONFIGURATOR_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ),
                    array(
                        'type' => 'password',
                        'name' => 'MYCONFIGURATOR_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }


    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return array(
            'MYCONFIGURATOR_LIVE_MODE' => Configuration::get('MYCONFIGURATOR_LIVE_MODE', true),
            'MYCONFIGURATOR_ACCOUNT_EMAIL' => Configuration::get('MYCONFIGURATOR_ACCOUNT_EMAIL', 'contact@prestashop.com'),
            'MYCONFIGURATOR_ACCOUNT_PASSWORD' => Configuration::get('MYCONFIGURATOR_ACCOUNT_PASSWORD', null),
        );
    }



    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }


    public function hookDisplayAfterBodyOpeningTag(){

        /* Place your code here. */
        $my_configuration_variable = Configuration::get('MY_CONFIGURATION_VARIABLE');
        $my_configuration_value = Configuration::get('MY_CONFIGURATION_VALUE');

        $this->context->smarty->assign('my_configuration_variable', $my_configuration_variable);
        $this->context->smarty->assign('my_configuration_value', $my_configuration_value);

        return $this->display(__FILE__, 'views/templates/hook/displayTop.tpl');

    }


    public function hookDisplayMyCustomFooterTwo(){
        $this->hookDisplayTop()();
    }

    public function hookDisplayMyCustomFooterOne(){
        $this->hookDisplayTop()();
    }


    public function hookDisplayMyCustomBlog(){
        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomBlog.tpl');
    }


    public function hookDisplayMyModals(){
        $this->p_();
        return $this->display(__FILE__, 'views/templates/hook/displayMyModals.tpl');
    }

    public function hookDisplayMyCustomPromocionesTerceras(){
        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomPromocionesTerceras.tpl');
    }

    public function hookDisplayMyCustomPromocionesSegundas(){
        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomPromocionesSegundas.tpl');
    }

    public function hookDisplayMyCustomMejoresVentas(){
        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomMejoresVentas.tpl');
    }


    public function hookDisplayMyCustomPromocionUnica(){
        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomPromocionUnica.tpl');
    }

    public function hookDisplayMyCustomNewArrivals(){
        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomNewArrivals.tpl');
    }

    public function hookDisplayMyCustomPromociones(){
        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomPromociones.tpl');
    }

    public function hookDisplayMyCustomReaseguros(){
        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomReaseguros.tpl');
    }

    public function hookDisplayMyCustomBanner(){
        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomBanner.tpl');
    }

    public function hookDisplayTop()
    {
        /*
        $my_configuration_variable = Configuration::get('MY_CONFIGURATION_VARIABLE');
        $my_configuration_value = Configuration::get('MY_CONFIGURATION_VALUE');

        $this->context->smarty->assign('my_configuration_variable', $my_configuration_variable);
        $this->context->smarty->assign('my_configuration_value', $my_configuration_value);

        return $this->display(__FILE__, 'views/templates/hook/displayMyCustomBanner.tpl');
        //return $this->display(__FILE__, 'views/templates/hook/displayTop.tpl');
        */
    }


    public function p_() {

        $args = func_get_args();
        $num_args = func_num_args();
        $label = "";

        $font_size = '14';
        $box_size = '10';
        $has_todo = false;
        $bg_color_div = 'white';
        $show_div = true;

        if($num_args>0){
            $last_arg = func_get_arg($num_args-1);
            echo "<div><pre>";
            echo "<div style='margin: 10px; margin-top: 70px; border:0px; padding: 2px;'>";
            $background_color = 'green';
            if(is_string($last_arg) && ($last_arg!="") && substr($last_arg,0,6)==='__lab:'){
                $label = substr($last_arg, 6, strlen($last_arg));
                unset($args[$num_args-1]);
                $label_error = strtolower($label);
                $background_color = '#FF8000';
                if($label_error == 'error' || $label_error == 'exception'){
                    $label = 'Exception';
                    $background_color = '#C42732';
                }
                if($label_error == 'dev_info'){
                    $label = 'Development info';
                    $background_color = '#C42732';
                    $font_size = '12';
                    $box_size = '5';
                }
                if($label_error == 'todo'){
                    $label = '!!!!!!!!!! Todo !!!!!!!!!!';
                    $background_color = '#f442b0';
                    $bg_color_div = '';
                    $font_size = '12';
                    $box_size = '5';
                    $has_todo = true;
                }
                if($label_error == 'empty'){
                    $show_div=false;
                }
            }else{
                $label = "PRINT";
            }

            $file_info_used = $this->print_debug('1', false, true);

            // if(is_string($last_arg) && ($last_arg!="") && substr($last_arg,0,4)==='__^:'){
            // 	$key_begins_with = substr($last_arg, 3, strlen($last_arg));
            // 	unset($args[$num_args-1]);
            // 	$label = "BEGINS WITH";
            // }
            if($show_div){
                echo "<div style='margin:10px; margin-bottom:10px;'>".
                    "<span style=\"background-color: $background_color; color: white; font-size: 12px; padding: ".$box_size ."px; border: 2px solid black;\"><b>"
                    . $label . "</b></span></div>";
            }

            $count = 1;

            foreach($args as $arg){
                if($show_div){
                    echo "<div style='margin: 10px 10px 2px 10px; border:2px solid black; padding: 5px; background-color: $bg_color_div;'>";
                }
                if(count($args)>1){
                    echo "<span style='font-size: 12px; font-weight: bold; color: red; padding:2px;'>Variable: ".$count."</span></br>";
                }
                if(is_string($arg)){
                    if(is_null($arg) || $arg == 'null'){
                        echo "<span style='color:red; font-weight: bold; font-size:".$font_size."px;'>".$arg."</span>";
                    }else{
                        echo "<span style='color:green; font-weight: bold; font-size: ".$font_size."px;'>".$arg."</span>";
                    }
                }else{
                    print_r($arg);
                }
                if($show_div){
                    echo "</div>";
                }
                // echo "<div style=\"height:10px;\"></div>";
                ++$count;
            }
            echo "<div style='font-style:italic; padding-left: 10px; font-size: 10px; text-align:right; margin:0px; padding: 0px;'>$file_info_used</div></div>";
            echo "</pre></div>";
            // echo "<br/>";
        }
        return;
    }

    public function print_debug($step_back=2, $fb=false, $file_info_only=false)
    {

        $debug = debug_backtrace();
        $function = $debug[$step_back]['function'];
        $line = isset($debug[$step_back]['line']) ? $debug[$step_back]['line'] : -1;
        $args = isset($debug[$step_back]['args']) ? $debug[$step_back]['args'] : -1;
        $file = isset($debug[$step_back]['file']) ? $debug[$step_back]['file'] : -1;
        if ($file_info_only) {
            return $file . ' => LINE:' . $line;
        }

        if ($fb == false) {
            d_('called function:' . $function);
            d_('called line:' . $line);
            d_('called arguments:' . $args);
            d_('called file:' . $file);
        } else {
            fb_('called function:' . $function);
            fb_('called line:' . $line);
            fb_('called arguments:' . $args);
            fb_('called file:' . $file);
        }

    }

}
