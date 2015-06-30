var sharp = require('sharp');

var ssfname = process.argv[2];
var toSize = process.argv[3];

sharp('R' + ssfname).resize(parseInt(toSize)).toFile(ssfname);
