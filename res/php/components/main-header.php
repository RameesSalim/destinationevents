<?php 
	function getHeader($selectedNavigation = 'home'){
		$navItems = [
			["id"=>"home","text"=>"HOME","url"=>"index.php","sub-items"=>[]],
			["id"=>"about","text"=>"ABOUT","url"=>"about.php","sub-items"=>[]],
			["id"=>"services","text"=>"SERVICES","url"=>"services.php",
				"sub-items"=>[
					["id"=>"wedding","text"=>"WEDDING","url"=>"services-wedding.php"],
					["id"=>"programme","text"=>"PROGRAMME","url"=>"services-wedding.php"],
					["id"=>"house_warming","text"=>"HOUSE WARMING","url"=>"services-wedding.php"],
					["id"=>"wedding2","text"=>"WEDDING","url"=>"services-wedding.php"],
				]
			],
			["id"=>"gallery","text"=>"GALLERY","url"=>"gallery.php","sub-items"=>[]],
			["id"=>"contact","text"=>"CONTACT","url"=>"contact.php","sub-items"=>[]],
		];

		$html = '
		<div class="header">
			<div class="header-content">
				<a href="index.html"><img src="res/images/dew_logo_header.jpg"/></a>
				<ul class="nav">';

		foreach ($navItems as $navItem) {
			$activeClass = array();
			$subHTML = "";
			if($navItem['id'] == $selectedNavigation){
				array_push($activeClass, "selected");
			}
			if(sizeof($navItem['sub-items']) > 0){
				array_push($activeClass, "sub");
				$subHTML .= '<ul class="sub-nav">';
				foreach ($navItem['sub-items'] as $subItem) {
					$subHTML .=  '<li><a href="'.$subItem['url'].'">'.$subItem['text'].'</a></li>';
				}
				$subHTML .= '</ul>';
			}


			$itemHTML = '<li';
			if(!empty($activeClass)){
				$itemHTML .= ' class="' . implode(" ", $activeClass) . '"';
			}
			$itemHTML .= '>';
			$itemHTML .= '<a href="'.$navItem['url'].'">'.$navItem['text'].'</a>';

			$itemHTML .= $subHTML;		
			$itemHTML .= '</li>';
			$html .= $itemHTML;
		}
		$html .= '
				</ul>
				<span class="humburger inactive"><i class="fas fa-bars"></i><i class="fas fa-times"></i></span>
			</div>
		</div>';

		return $html;
	}
?>