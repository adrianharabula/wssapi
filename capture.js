var casper = require('casper').create({
    viewportSize: {
        width: 320,
		height: 480
    }
});

if (casper.cli.args.length < 1) {
  casper
    .echo("Usage: $ casperjs capture.js http://example.com outputfile,jpg [viewportWidth] [viewportHeight] [maxHeight] [paddingTop] [paddingLeft]")
    .exit(1)
  ;
} else {
	var screenshotUrl = casper.cli.args[0];
	var outputfile = casper.cli.args[1];
	var vw = casper.cli.args[2];
	var vh = casper.cli.args[3];
	var maxHeight = casper.cli.args[4];
	var paddingTop = casper.cli.args[5];
	var paddingLeft = casper.cli.args[6];
}

casper.start(screenshotUrl, function() {
	casper.viewport(vw, vh, function() {

		if(maxHeight == 0) this.capture(outputfile, null, { format: 'jpg', quality: '72' } );
			else
	    this.capture(
		outputfile,
		{
		  top: paddingTop,
		  left: paddingLeft,
		  width: vw,
		  height: maxHeight,
		},
		{
		  format: 'jpg',
		  quality: '72'
		}
	    );
	});
});

casper.run();
