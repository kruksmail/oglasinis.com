<?php
require_once APPLICATION_PATH . '/modules/oglas/library/Content/Item/AbstractAbstract.php';
class Prijateljskisajtovi_Content_Item__OglasTemplate extends Prijateljskisajtovi_Content_Item_AbstractAbstract {
	public $id;
	public $kategorija;
	public $podkategorija;
	public $name;
	public $nameContent;
	public $date_createdContent;
	public $grad;
	public $ponudatraznja;
	public $adresa;
	public $telefoni;
	public $trajanjeoglasa;
	public $email;
	public $sajt;
	public $cena;
	public $valuta;
	public $detalji;
	public $ipoglasivaca;
	public $oglasivac;
	public $glavnaslika;
	public $slikadva;
	public $slikatri;
	public $slikacetri;
	public $proveren;
		
	protected $_namespace = 'oglas';

}
?>