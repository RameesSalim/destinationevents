<?php 
	function getAdminNavigation($selectedNavigation){
		$navItems = [
			["id"=>"home","text"=>"Testimonials","url"=>"admin-testimonials.php","feather"=>"user"],
			["id"=>"photogrid","text"=>"Home Photo Grid","url"=>"admin-photo-grid.php","feather"=>"grid"],
			["id"=>"gallery","text"=>"Gallery","url"=>"admin-gallery.php","feather"=>"image"]
			// ["id"=>"gallery-images","text"=>"Gallery Images","url"=>"admin-gallery-images.php","feather"=>"home"]
		];

		$html = '<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">';

        foreach ($navItems as $key => $value) {
        	$html .= '
        	<li class="nav-item">
                <a class="nav-link '.( $selectedNavigation == $value['id'] ? 'active':'').'" href="'.$value['url'].'">
                  <span data-feather="'.$value['feather'].'"></span>
                  '.$value['text'].' '.( $selectedNavigation == $value['id'] ? ' <span class="sr-only">(current)</span>':'').'
                </a>
            </li>
			';
        }

        $html .=    '</ul>
          </div>
        </nav>';		
		return $html;
	}
?>