/*jslint white: true, browser: true, undef: true, nomen: true, eqeqeq: true, plusplus: false, bitwise: true, regexp: true, strict: true, newcap: true, immed: true, maxerr: 14 */
/*global window: false, REDIPS: true */

/* enable strict mode */
"use strict";

// define init and show methods
var redipsInit,
	showContent,
	getContent;

// redips initialization
redipsInit = function () {
	var num = 0,			// number of successfully placed elements
		rd = REDIPS.drag;	// reference to the REDIPS.drag lib
	// initialization
	rd.init();
	// set hover color
	rd.hover.colorTd = '#9BB3DA';
	// call initially showContent
	showContent();
	// on each drop refresh content
	rd.event.dropped = function () {
		showContent();
	};
	// call showContent() after DIV element is deleted
	rd.event.deleted = function () {
		showContent();
	};
};


// show TD content
showContent = function () {
	// get content of TD cells in right table
	var emuhome0 = getContent('emuhome0'),
		emuhome1 = getContent('emuhome1'),
		emuhome2 = getContent('emuhome2'),
		emuhome3 = getContent('emuhome3'),
		emuhome4 = getContent('emuhome4'),
		// set reference to the message DIV (below tables)
		message = document.getElementById('message');
	// show block content
	message.innerHTML = 'Main Featured Story = ' + emuhome0 + '<br>' +
						'Featured Story 1 = ' + emuhome1 + '<br>' +
						'Featured Story 2 = ' + emuhome2 + '<br>' +
						'Featured Story 3 = ' + emuhome3 + '<br>' +
						'Featured Story 4 = ' + emuhome4;
};


// get content (DIV elements in TD)
getContent = function (id) {
	var td = document.getElementById(id),
		content = '',
		cn, i;
	// TD can contain many DIV elements
	for (i = 0; i < td.childNodes.length; i++) {
		// set reference to the child node
		cn = td.childNodes[i];
		// childNode should be DIV with containing "drag" class name
		if (cn.nodeName === 'DIV' && cn.className.indexOf('drag') > -1) { // and yes, it should be uppercase
			// append DIV id to the result string
			content += cn.id + '_';
		}
	}
	// cut last '_' from string
	content = content.substring(0, content.length - 1);
	// return result
	return content;
};


// add onload event listener
if (window.addEventListener) {
	window.addEventListener('load', redipsInit, false);
}
else if (window.attachEvent) {
	window.attachEvent('onload', redipsInit);
}
