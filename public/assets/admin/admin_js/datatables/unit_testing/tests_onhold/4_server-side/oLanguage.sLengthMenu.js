// DATA_TEMPLATE: empty_table
oTest.fnStart( "oLanguage.sLengthMenu" );

$(document).ready( function () {
	/* Check the default */
	var oTable = $('#example').dataTable( {
		"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.php"
	} );
	var oSettings = oTable.fnSettings();
	
	oTest.fnWaitTest( 
		"Menu language is 'Show _MENU_ entries' by default",
		null,
		function () { return oSettings.oLanguage.sLengthMenu == "Show _MENU_ entries"; }
	);
	
	oTest.fnTest(
		"_MENU_ macro is replaced by select menu in DOM",
		null,
		function () { return $('select', oSettings.aanFeatures.l[0]).length == 1 }
	);
	
	oTest.fnTest(
		"A label input is used",
		null,
		function () { return $('label', oSettings.aanFeatures.l[0]).length == 1 }
	);
	
	oTest.fnTest(
		"Default is put into DOM",
		null,
		function () {
			var anChildren = $('label',oSettings.aanFeatures.l[0])[0].childNodes;
			var bReturn =
				anChildren[0].nodeValue == "Show " &&
				anChildren[2].nodeValue == " entries";
			return bReturn;
		}
	);
	
	
	oTest.fnWaitTest( 
		"Menu length language can be defined - no _MENU_ macro",
		function () {
			oSession.fnRestore();
			oTable = $('#example').dataTable( {
				"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.php",
				"oLanguage": {
					"sLengthMenu": "unit test"
				}
			} );
			oSettings = oTable.fnSettings();
		},
		function () { return oSettings.oLanguage.sLengthMenu == "unit test"; }
	);
	
	oTest.fnTest( 
		"Menu length language definition is in the DOM",
		null,
		function () {
			return $('label', oSettings.aanFeatures.l[0]).text() == "unit test";
		}
	);
	
	
	oTest.fnWaitTest( 
		"Menu length language can be defined - with _MENU_ macro",
		function () {
			oSession.fnRestore();
			oTable = $('#example').dataTable( {
				"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.php",
				"oLanguage": {
					"sLengthMenu": "unit _MENU_ test"
				}
			} );
			oSettings = oTable.fnSettings();
		},
		function () {
			var anChildren = $('label',oSettings.aanFeatures.l[0])[0].childNodes;
			var bReturn =
				anChildren[0].nodeValue == "unit " &&
				anChildren[2].nodeValue == " test";
			return bReturn;
		}
	);
	
	
	oTest.fnWaitTest( 
		"Only the _MENU_ macro",
		function () {
			oSession.fnRestore();
			oTable = $('#example').dataTable( {
				"bServerSide": true,
		"sAjaxSource": "../../../examples/server_side/scripts/server_processing.php",
				"oLanguage": {
					"sLengthMenu": "_MENU_"
				}
			} );
			oSettings = oTable.fnSettings();
		},
		function () {
			var anChildren = oSettings.aanFeatures.l[0].childNodes;
			var bReturn =
				anChildren.length == 1 &&
				$('select', oSettings.aanFeatures.l[0]).length == 1;
			return bReturn;
		}
	);
	
	
	oTest.fnComplete();
} );