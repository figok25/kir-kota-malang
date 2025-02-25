
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SIMPKB Online BeSmart</title>
	<link rel="stylesheet" href="themes/besmarty.min.css" />
	<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="themes/jquery.mobile.structure-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	  <style id="combined-heading-and-section">
    .custom-corners .ui-bar {
      -webkit-border-top-left-radius: inherit;
      border-top-left-radius: inherit;
      -webkit-border-top-right-radius: inherit;
      border-top-right-radius: inherit;
    }
    .custom-corners .ui-body {
      border-top-width: 0;
      -webkit-border-bottom-left-radius: inherit;
      border-bottom-left-radius: inherit;
      -webkit-border-bottom-right-radius: inherit;
      border-bottom-right-radius: inherit;
    }
  </style>	
</head>
<body>
<div data-role="page" id="panel-fixed-page1" data-title="Panel fixed positioning" data-url="panel-fixed-page1">
    <div style="height:42px;overflow:hidden" data-role="header" data-position="fixed">
        <h2 style="margin-top:-20px;" >Fixed header</h2>
		<a href="http://besmarty.ip-dynamic.com/simpkb/" class="ui-btn-left ui-btn-corner-all ui-btn ui-icon-home ui-btn-icon-notext ui-shadow" title=" Home " data-form="ui-icon" data-role="button" role="button"> Home </a>
		<a href="#nav-panel" class="ui-btn-right ui-btn-corner-all ui-btn ui-icon-grid ui-btn-icon-notext ui-shadow" title=" Navigation " data-form="ui-icon" data-role="button" role="button"> Navigation </a>
    </div><!-- /header -->
    <div role="main" class="ui-content jqm-content jqm-fullwidth">
        <h1>Panel fixed positioning</h1>
        <p>This is a typical page that has two buttons in the header bar that open panels. The left panel has the push display mode. The right panel opens as overlay. For both panels we set <code>data-position-fixed="true"</code>. We also set position fixed for the header and footer on this page.</p>
        <p>The left panel contains a long menu to demonstrate that the framework will check the panel contents height and unfixes the panel so its content can be scrolled. In the right panel there is a short form that shows the fixed positioning.</p>
        <div data-demo-html="#panel-fixed-page1"></div><!--/demo-html -->
        <br>
        <br>
        <br>
        <br>
        <br>
        <a href="../" data-rel="back" data-ajax="false" class="ui-btn ui-shadow ui-corner-all ui-mini ui-btn-inline ui-icon-carat-l ui-btn-icon-left ui-alt-icon ui-nodisc-icon">Back</a>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p>We made the page a bit longer because you only see the panel fixed positioning if you can scroll the page :-)</p>
    </div><!-- /content -->

    <div style="margin-top:-40px;" data-role="panel" data-position="right" data-position-fixed="true" data-display="push" data-theme="b" id="nav-panel">
        <ul data-role="listview">
            <li style="height:22px" data-icon="delete"><a href="#" data-rel="close">Tutup</a></li>
            <li style="height:22px" ><a href="#panel-fixed-page2">Accordion</a></li>
            <li style="height:22px" ><a href="#panel-fixed-page2">Ajax Navigation</a></li>
            <li style="height:22px" ><a href="#panel-fixed-page2">Autocomplete</a></li>
            <li style="height:22px" ><a href="#panel-fixed-page2">Buttons</a></li>


        </ul>
    </div><!-- /panel -->
    <div data-role="panel" data-position="left" data-position-fixed="true" data-display="overlay" data-theme="a" id="add-form">
        <form class="userform">
            <h2>Login</h2>
            <label for="name">Username:</label>
            <input type="text" name="name" id="name" value="" data-clear-btn="true" data-mini="true">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="" data-clear-btn="true" autocomplete="off" data-mini="true">
            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-b ui-mini">Cancel</a></div>
                <div class="ui-block-b"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-mini">Save</a></div>
            </div>
        </form>
    </div><!-- /panel -->
</div>

</div>
		</div>
	</div>
</body>
</html>