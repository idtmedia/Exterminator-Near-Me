<div class="lp-search-bar">
   <form autocomplete="off" class="form-inline" action="" method="POST" accept-charset="UTF-8">
      <div class="form-group lp-suggested-search hide-where ">
         <div class="pos-relative">
            <div class="what-placeholder pos-relative" data-holder="">
               <input autocomplete="off" type="text" class="lp-suggested-search js-typeahead-input lp-search-input form-control ui-autocomplete-input dropdown_fields" name="select" id="select" placeholder="Enter a US ZIP Code.." data-prev-value='0' data-noresult = "More results for">
               <i class="cross-search-q fa fa-times-circle" aria-hidden="true"></i>
               <img class='loadinerSearch' width="100px" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/search-load.gif"/>
            </div>
         </div>
      </div>
      <div class="form-group pull-right search-hide">
         <div class="lp-search-bar-right">
            <input value="Search" class="lp-search-btn" type="submit">
            <i class="icons8-search lp-search-icon"></i>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ellipsis.gif" class="searchloading">
            <!--
               <img src="/assets/images/searchloader.gif" class="searchloading">
               -->
         </div>
      </div>
   </form>
</div>