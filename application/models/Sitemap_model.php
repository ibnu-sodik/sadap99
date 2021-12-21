<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		$this->urls = array();
		$this->changefreqs = array(
			'always',
			'hourly',
			'daily',
			'weekly',
			'monthly',
			'yearly',
			'never'
		);
	}

	public function add($loc, $lastmod = NULL, $changefreq = NULL, $priority = NULL) {
			// Do not continue if the changefreq value is not a valid value
		if ($changefreq !== NULL && !in_array($changefreq, $this->changefreqs)) {
			show_error('Unknown value for changefreq: '.$changefreq);
			return false;
		}
			// Do not continue if the priority value is not a valid number between 0 and 1 
		if ($priority !== NULL && ($priority < 0 || $priority > 1)) {
			show_error('Invalid value for priority: '.$priority);
			return false;
		}
		$item = new stdClass();
		$item->loc = $loc;
		$item->lastmod = $lastmod;
		$item->changefreq = $changefreq;
		$item->priority = $priority;
		$this->urls[] = $item;
		
		return true;
	}

	public function output($type = 'urlset') {
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><'.$type.'/>');
		$xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
		if ($type == 'urlset') {
			foreach ($this->urls as $url) {
				$child = $xml->addChild('url');
				$child->addChild('loc', strtolower($url->loc));
				if (isset($url->lastmod)) $child->addChild('lastmod', $url->lastmod);
				if (isset($url->changefreq)) $child->addChild('changefreq', $url->changefreq);
				if (isset($url->priority)) $child->addChild('priority', number_format($url->priority, 1));
			}
		} elseif ($type == 'sitemapindex') {
			foreach ($this->urls as $url) {
				$child = $xml->addChild('sitemap');
				$child->addChild('loc', strtolower($url->loc));
				if (isset($url->lastmod)) $child->addChild('lastmod', $url->lastmod);
			}
		}
		$this->output->set_content_type('application/xml')->set_output($xml->asXml());
	}
	
	public function clear() {
		$this->urls = array();
		return true;
	}

}

/* End of file Sitemap_model.php */
/* Location: ./application/models/Sitemap_model.php */

?>