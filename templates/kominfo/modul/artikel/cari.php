   
   
   
   
   
    <script src="https://www.google.com/jsapi?key=ABQIAAAAFEyVt-pBJaTXzM__EKlCrBTsyyvZhuBjP1YLRoRPwle1bnzSQRQBJp693I-9cLRWqwHDWCO_xmGezQ"
        type="text/javascript"></script>
    <script type="text/javascript">
      google.load("search", "1", {"language" : "id"});

      // Call this function when the page has been loaded
      function initialize() {
        var searchControl = new google.search.SearchControl();
		
		// site restricted web search
		var siteSearch = new google.search.WebSearch();
		siteSearch.setUserDefinedLabel("<?php include "terasconfig/nama_web.php";?>");
		siteSearch.setUserDefinedClassSuffix("siteSearch");
		siteSearch.setSiteRestriction("<?php include "terasconfig/url.php";?>");
		searchControl.addSearcher(siteSearch);
			
		//Search API Topics
		searchControl.addSearcher(new google.search.WebSearch());
        searchControl.setNoResultsString('Mohon maaf data yang anda cari tidak ada.');

			
		// create a drawOptions object
		var drawOptions = new google.search.DrawOptions();
		// tell the searcher to draw itself in tabbed mode
		drawOptions.setDrawMode(google.search.SearchControl.DRAW_MODE_TABBED);
		searchControl.draw(document.getElementById("searchcontrol"), drawOptions);
      }
      google.setOnLoadCallback(initialize);
    </script>
	
	
	
	
	
	
<style type="text/css">
.gsc-results {
    width: 600px;
}

#searchcontrol {
    width: 600px;
    margin-top: 30px;
}

.gsc-control {
    width: 350px;
}

.gsc-branding {
    display: none;
}

.gs-title a {
    color: orange;
    font-weight: bold;
}

#searchcontrol a {
    color: 606060;
text-decoration: none;

}

.gsc-control-cse {
    font-family: arial;
    font-size: 12px;
    border-color: #ccc;
    background-color: #ccc;
}

input.gsc-input {
    width: 300px;
    padding: 7px 10px;
    border: none;
    outline: none;
    background:#efefef;
    float: left;
    margin: 0px;
    line-height: 17px;
    font-size: 13px;
    height:35px;
    color: #606060;
    margin: 0px;
}

input.gsc-search-button {
    padding: 5.5px 10px;
    background:orange;
    border: none;
    outline: none;
    color: #fff;
    font-family: arial;
    font-size: 12px;
    line-height: 12px;
    height: 35px;
    margin-left: -10px;
    float: left;
    clear: none;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    font-weight: bold;
}

.gsc-tabHeader.gsc-tabhInactive {
    background-color:#e2e2e2;
    font-family: arial;
    font-size: 12px;
    padding: 3px 8px 5px 8px;
    font-weight: bold;
}

.gsc-tabHeader.gsc-tabhActive {
    background-color: #fff;
    font-family: arial;
    font-size: 12px;
    padding: 3px 8px 5px 8px;
    color: #606060;
}

.gsc-tabsArea {
    border: 1px solid #fff;
    font-family: arial;
    font-size: 12px;
    font-weight: bold;
    margin-top: 20px;
}

.gsc-webResult.gsc-result {
    font-family: arial;
    font-size: 12px;
    border-color: #e2e2e2;
    background-color: #fff;
    padding: 10px;
}

.gsc-webResult.gsc-result:hover {
    background-color:#F3F3F3;
    font-family: arial;
    font-size: 12px;
    border: 1px solid #fff;
    padding: 10px;
}

.gs-webResult.gs-result a.gs-title:link,
.gs-webResult.gs-result a.gs-title:link b {
    color: orange;
    text-decoration: none;
    font-family: arial;
    font-size: 12px;
}

.gs-visibleUrl, .gs-visibleUrl-short {
    color: #ccc !important;
}

/* Pagination container centered */
.cse .gsc-cursor-box,
.gsc-cursor-box {
    border-top: 1px dotted;
    border-color: #333333;
    padding: .5em 0 0 .5em;
    text-align: left;
    font-family: arial;
    color: #ccc;
    font-size: 12px;
}



/* Selected pagination */
.cse .gsc-results .gsc-cursor-page.gsc-cursor-current-page,
.gsc-results .gsc-cursor-page.gsc-cursor-current-page {
    color: #606060;
background-color:orange;    
font-family: arial;
    font-size: 12px;
    padding: 0 5px;
}
</style>

	
	
    <div id="searchcontrol">
	<span class style=\"color:#EA1C1C;font-family:arial;font-size:15px;\">
	mohon tunggu sesaat  <img src=<?php echo "$f[folder]/images/ajax-loader.gif" ?> width="16" height="11"/></span>
	</div>
