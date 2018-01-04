<?PHP

	if(get_theme_mod("pagination")=="on"){

		$links = paginate_links( array( "prev_text" => _x("Previous", 'Before this one', 'pop-up-pigeon'), "next_text" => _x("Next", 'After this one', 'pop-up-pigeon') ));
		
		if($links!=""){ ?>
			<footer class="page-footer">
				<h1 class="pagination"><span class='more'><?PHP
					echo _x('More content', 'See more pages with of this type', 'pop-up-pigeon');
				?></span><?PHP
			
				echo $links;
				
				?></h1>
			</footer><?PHP
			
		}
		
	}
