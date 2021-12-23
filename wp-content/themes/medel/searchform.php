<form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url('/')) ?>" >
	<button type="submit" class="searchsubmit" value=""><i class="fa fa-search"></i></button>
	<div><input type="text" value="<?php echo esc_attr(get_search_query()) ?>" placeholder="<?php echo esc_attr__('Type and hit enter', 'medel') ?>" name="s" class="input" /></div>
</form>