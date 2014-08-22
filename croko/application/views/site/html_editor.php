<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
<title>ACE in Action</title>
<style type="text/css" media="screen">
    #editor { 
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
</head>
<body>

<div id="editor"><xmp><?=tidyHTML($content);?></xmp></div>
    
<script src="http://d1n0x3qji82z53.cloudfront.net/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>

    var editor = ace.edit("editor");

    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/xml");

    document.getElementById('editor').style.fontSize='14px';

	editor.getSession().setUseWrapMode(true);

</script>
</body>
</html>