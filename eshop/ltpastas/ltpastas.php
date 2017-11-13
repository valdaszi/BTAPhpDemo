<?php

// Avoid direct access to the file
if (!defined('_PS_VERSION_'))
	exit;

class LtPastas extends CarrierModule
{
	public  $id_carrier;

	private $_html = '';
	private $_postErrors = array();

	private static $moduleName = 'ltpastas';
	private static $tableName = 'ltpastas_distance';


	/*
	** Construct Method
	**
	*/

	public function __construct()
	{
		$this->name = 'ltpastas';
		$this->tab = 'shipping_logistics';
		$this->version = '1.1';
		$this->author = 'Jonas Petras';
		$this->limited_countries = array('lt');

		parent::__construct ();

		$this->displayName = $this->l('LT Paštas');
		$this->description = $this->l('LT Pašto siuntų pristatymo tarnyba');

		if (self::isInstalled($this->name))
		{
			// Getting carrier list
			global $cookie;
			$carriers = Carrier::getCarriers($cookie->id_lang, true, false, false, NULL, PS_CARRIERS_AND_CARRIER_MODULES_NEED_RANGE);

			// Saving id carrier list
			$id_carrier_list = array();
			foreach($carriers as $carrier)
				$id_carrier_list[] .= $carrier['id_carrier'];

			// Testing if Carrier Id exists
			$warning = array();
			if (!in_array((int)(Configuration::get('LTPASTAS_CARRIER_ID')), $id_carrier_list))
				$warning[] .= $this->l('"LT Paštas"').' ';
			
			if (count($warning))
				$this->warning .= implode(' , ',$warning).$this->l('must be configured to use this module correctly').' ';
		}
	}


	/*
	** Install / Uninstall Methods
	**
	*/

	public function install()
	{
		$carrierConfig = array(
			0 => array(
				'name' => 'LT Paštas',
				'logo' => (dirname(__FILE__).'/carrier.png'),
				'id_tax_rules_group' => 0,
				'active' => true,
				'deleted' => 0,
				'shipping_handling' => false,
				'range_behavior' => 0,
				'delay' => array('lt' => 'LT Pašto siuntų pristatymo tarnyba', 'en' => 'LT Post service', Language::getIsoById(Configuration::get('PS_LANG_DEFAULT')) => 'LT Pašto siuntų pristatymo tarnyba'),
				'id_zone' => 1,
				'is_module' => true,
				'shipping_external' => true,
				'external_module_name' => 'ltpastas',
				'need_range' => true
			),
		);

		if (!self::installDb()) {
            return false;
        }

		$id_carrier1 = $this->installExternalCarrier($carrierConfig[0]);
		Configuration::updateValue('LTPASTAS_CARRIER_ID', (int)$id_carrier1);
		if (!parent::install() ||
		    !$this->registerHook('updateCarrier'))
			return false;
		return true;
	}
	
	public function uninstall()
	{
		// Uninstall
		if (!parent::uninstall() ||
			!self::uninstallDb() ||
		    !$this->unregisterHook('updateCarrier'))
			return false;
		
		// Delete External Carrier
		$Carrier1 = new Carrier((int)(Configuration::get('LTPASTAS_CARRIER_ID')));

		// If external carrier is default set other one as default
		if (Configuration::get('PS_CARRIER_DEFAULT') == (int)($Carrier1->id))
		{
			global $cookie;
			$carriersD = Carrier::getCarriers($cookie->id_lang, true, false, false, NULL, PS_CARRIERS_AND_CARRIER_MODULES_NEED_RANGE);
			foreach($carriersD as $carrierD)
				if ($carrierD['active'] AND !$carrierD['deleted'] AND ($carrierD['name'] != $this->_config['name']))
					Configuration::updateValue('PS_CARRIER_DEFAULT', $carrierD['id_carrier']);
		}

		// Then delete Carrier
		$Carrier1->deleted = 1;
		if (!$Carrier1->update())
			return false;

		return true;
	}

	public static function installExternalCarrier($config)
	{
		$carrier = new Carrier();
		$carrier->name = $config['name'];
		$carrier->id_tax_rules_group = $config['id_tax_rules_group'];
		$carrier->id_zone = $config['id_zone'];
		$carrier->active = $config['active'];
		$carrier->deleted = $config['deleted'];
		$carrier->delay = $config['delay'];
		$carrier->shipping_handling = $config['shipping_handling'];
		$carrier->range_behavior = $config['range_behavior'];
		$carrier->is_module = $config['is_module'];
		$carrier->shipping_external = $config['shipping_external'];
		$carrier->external_module_name = $config['external_module_name'];
		$carrier->need_range = $config['need_range'];

		$languages = Language::getLanguages(true);
		foreach ($languages as $language)
		{
			if ($language['iso_code'] == 'lt')
				$carrier->delay[(int)$language['id_lang']] = $config['delay'][$language['iso_code']];
			if ($language['iso_code'] == 'en')
				$carrier->delay[(int)$language['id_lang']] = $config['delay'][$language['iso_code']];
			if ($language['iso_code'] == Language::getIsoById(Configuration::get('PS_LANG_DEFAULT')))
				$carrier->delay[(int)$language['id_lang']] = $config['delay'][$language['iso_code']];
		}

		if ($carrier->add())
		{
			$groups = Group::getGroups(true);
			foreach ($groups as $group)
				Db::getInstance()->autoExecute(_DB_PREFIX_.'carrier_group', array('id_carrier' => (int)($carrier->id), 'id_group' => (int)($group['id_group'])), 'INSERT');

			$rangePrice = new RangePrice();
			$rangePrice->id_carrier = $carrier->id;
			$rangePrice->delimiter1 = '0';
			$rangePrice->delimiter2 = '10000';
			$rangePrice->add();

			$rangeWeight = new RangeWeight();
			$rangeWeight->id_carrier = $carrier->id;
			$rangeWeight->delimiter1 = '0';
			$rangeWeight->delimiter2 = '10000';
			$rangeWeight->add();

			$zones = Zone::getZones(true);
			foreach ($zones as $zone)
			{
				Db::getInstance()->autoExecute(_DB_PREFIX_.'carrier_zone', array('id_carrier' => (int)($carrier->id), 'id_zone' => (int)($zone['id_zone'])), 'INSERT');
				Db::getInstance()->autoExecuteWithNullValues(_DB_PREFIX_.'delivery', array('id_carrier' => (int)($carrier->id), 'id_range_price' => (int)($rangePrice->id), 'id_range_weight' => NULL, 'id_zone' => (int)($zone['id_zone']), 'price' => '0'), 'INSERT');
				Db::getInstance()->autoExecuteWithNullValues(_DB_PREFIX_.'delivery', array('id_carrier' => (int)($carrier->id), 'id_range_price' => NULL, 'id_range_weight' => (int)($rangeWeight->id), 'id_zone' => (int)($zone['id_zone']), 'price' => '0'), 'INSERT');
			}

			// Copy Logo
			if (!copy(dirname(__FILE__).'/carrier.jpg', _PS_SHIP_IMG_DIR_.'/'.(int)$carrier->id.'.jpg'))
				return false;

			// Return ID Carrier
			return (int)($carrier->id);
		}

		return false;
	}

	/*
	** DB Methods
	**
	*/

	private static function getPath($dirname)
    {
        return _PS_MODULE_DIR_.self::$moduleName.'/'.$dirname;
    }

	private static function loadSQLFile($sql_file)
    {
        $result = true;
        $sql_content = Tools::file_get_contents($sql_file);
        $sql_content = str_replace('PREFIX_', _DB_PREFIX_, $sql_content);
		if (!empty($sql_content)) {
			$result &= Db::getInstance()->execute(trim($sql_content));
		}
        return $result;
    }

	private static function installDb()
	{
 		$sql_file = self::getPath('sql').'/install.sql';
        self::loadSQLFile($sql_file);
        return true;
	}

	private static function uninstallDb() 
	{
		$sql_file = self::getPath('sql').'/uninstall.sql';
        self::loadSQLFile($sql_file);
        return true;
	}

	private static function checkDb($a1, $a2)
	{
		$sql = 'SELECT distance FROM '._DB_PREFIX_.self::$tableName.
			' WHERE '.
			"`store` = '".pSQL($a1)."' AND `destination` = '".pSQL($a2)."'";
		return Db::getInstance()->getValue($sql);
	}

	private static function saveDb($a1, $a2, $distance)
	{
		return Db::getInstance()->insert(self::$tableName, array(
    		'store' => pSQL($a1),
			'destination' => pSQL($a2),
    		'distance' => (int) $distance,
		));
	}


	/*
	** Form Config Methods
	**
	*/

	public function getContent()
	{
		$this->_html .= '<h2>' . $this->l('LT Paštas').'</h2>';
		// $this->_html .= '<legend><img src="'.$this->_path.'logo.png" alt="" /> '.$this->l('LT Paštas Module Status').'</legend>';
		// $this->_html .= '<img src="'._PS_IMG_.'admin/module_install.png" /><strong>'.$this->l('LT Paštas is configured and online!').'</strong>';

		if (!empty($_POST) AND Tools::isSubmit('submitSave'))
		{
			$this->_postValidation();
			if (!sizeof($this->_postErrors))
				$this->_postProcess();
			else
				foreach ($this->_postErrors AS $err)
					$this->_html .= '<div class="alert error"><img src="'._PS_IMG_.'admin/forbbiden.gif" alt="nok" />&nbsp;'.$err.'</div>';
		}
		$this->_displayForm();
		return $this->_html;
	}

	private function _displayForm()
	{
		$this->_html .= '<fieldset>
		<legend><img src="'.$this->_path.'logo.png" alt="" /> '.$this->l('LT Paštas Module Status').'</legend>';

		//$alert = array();
		if (!Configuration::get('LTPASTAS_ADDRESS') || Configuration::get('LTPASTAS_ADDRESS') == '') {
			$alert = 1;
		}

		if (!$alert) {
			$this->_html .= '<img src="'._PS_IMG_.'admin/module_install.png" /><strong>'.$this->l('LT Paštas is configured and online!').'</strong>';
		} else {
			$this->_html .= '<img src="'._PS_IMG_.'admin/warn2.png" /><strong>'.$this->l('LT Paštas is not configured yet, please:').'</strong>';
			$this->_html .= '<br /><img src="'._PS_IMG_.'admin/warn2.png" />'.$this->l('Configure LT Paštas store address');
		}

		$this->_html .= '</fieldset><div class="clear">&nbsp;</div>
			<style>
				#tabList { clear: left; }
				.tabItem { display: block; background: #FFFFF0; border: 1px solid #CCCCCC; padding: 10px; padding-top: 20px; }
			</style>
			<div id="tabList">
				<div class="tabItem">
					<form action="index.php?tab='.Tools::getValue('tab').'&configure='.Tools::getValue('configure').'&token='.Tools::getValue('token').'&tab_module='.Tools::getValue('tab_module').'&module_name='.Tools::getValue('module_name').'&id_tab=1&section=general" method="post" class="form" id="configForm">

					<fieldset style="border: 0px;">
						<h4>'.$this->l('General configuration').' :</h4>
						<label>'.$this->l('LT Paštas store address').' : </label>
						<div class="margin-form"><input type="text" size="100" name="ltpastas_address" value="'.Tools::getValue('ltpastas_address', Configuration::get('LTPASTAS_ADDRESS')).'" /></div>
					</div>
					<br /><br />
				</fieldset>				
				<div class="margin-form"><input class="button" name="submitSave" type="submit"></div>
			</form>
		</div></div>';
	}

	private function _postValidation()
	{
		// Check configuration values
		if (Tools::getValue('ltpastas_address') == '')
			$this->_postErrors[]  = $this->l('You have to configure the carrier');
	}

	private function _postProcess()
	{
		// Saving new configurations
		if (Configuration::updateValue('LTPASTAS_ADDRESS', Tools::getValue('ltpastas_address')))
			$this->_html .= $this->displayConfirmation($this->l('Settings updated'));
		else
			$this->_html .= $this->displayErrors($this->l('Settings failed'));
	}


	/*
	** Hook update carrier
	**
	*/

	public function hookupdateCarrier($params)
	{
		if ((int)($params['id_carrier']) == (int)(Configuration::get('LTPASTAS_CARRIER_ID')))
			Configuration::updateValue('LTPASTAS_CARRIER_ID', (int)($params['carrier']->id));
	}




	/*
	** Front Methods
	**
	** If you set need_range at true when you created your carrier (in install method), the method called by the cart will be getOrderShippingCost
	** If not, the method called will be getOrderShippingCostExternal
	**
	** $params var contains the cart, the customer, the address
	** $shipping_cost var contains the price calculated by the range in carrier tab
	**
	*/
	
	public function getOrderShippingCost($params, $shipping_cost)
	{
		// This example returns shipping cost with overcost set in the back-office, but you can call a webservice or calculate what you want before returning the final value to the Cart
		if ($this->id_carrier == (int)(Configuration::get('LTPASTAS_CARRIER_ID'))) {
			//var_dump($params);
			//
			// $total = 0;
			// $products = $params->getProducts();
			// if (is_array($products)) {
			// 	foreach ($products as $product) {
			// 		$total += $product['total_wt'];	
			// 	}
			// }
			// return $total * 0.1;

			$address = new Address($params->id_address_delivery); 
			//var_dump($address);

			// $storeAddress = new Address();
			// $storeAddress->postcode = '51423';
			// $storeAddress->city = 'Kaunas';
			// $storeAddress->country = 'Lietuva';

			$dist = $this->distance($address);
			return $dist * 0.5;
		}

		// If the carrier is not known, you can return false, the carrier won't appear in the order process
		return false;
	}
	
	private function distance($address2)
	{
		//$a1 = $address1->city . ' ' . $address1->postcode . ', ' . $address1->country;
		$a1 = Configuration::get('LTPASTAS_ADDRESS');
		$a2 = $address2->city . ' ' . $address2->postcode . ', ' . $address2->country;

		$distance = self::checkDb($a1, $a2);
		
		if ($distance === false) {
			$distance = $this->requestDistance($a1, $a2);
			self::saveDb($a1, $a2, $distance);
		}

		return $distance / 1000.0;
	}

	private function requestDistance($a1, $a2)
	{
		$from = urlencode($a1);
		$to = urlencode($a2);
		$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
		$response = json_decode($data);
		$time = 0;
		$distance = 0;
		foreach ($response->rows[0]->elements as $road) {
			$time += $road->duration->value;		// s
			$distance += $road->distance->value;	// m
		}
		return $distance / 1000.0; // in km
	}

	public function getOrderShippingCostExternal($params)
	{
		// This example returns the overcost directly, but you can call a webservice or calculate what you want before returning the final value to the Cart
		if ($this->id_carrier == (int)(Configuration::get('LTPASTAS_CARRIER_ID')))
			return (float) 43.21;

		// If the carrier is not known, you can return false, the carrier won't appear in the order process
		return false;
	}
	
}


