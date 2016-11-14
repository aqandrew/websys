window.onload = doStuff;

function doStuff() {
	addQuote();
	document.getElementById("info").innerHTML = printDom(document.documentElement, -1);
	addMouseover();
}

function addMouseover() {
	let divs = document.getElementsByTagName('div');
	
	for (var i = 0; i < divs.length; i++) {
		divs[i].addEventListener('mouseover', function () {
			this.className = 'quote mouse-over';
		});
		divs[i].addEventListener('mouseout', function () {
			this.className = 'quote';
		});
	}
}

function addQuote() {
	var myQuote = 'Live well and live broadly. You are alive and living now. Now is the envy of all of the dead.';
	var myAttribution = 'Emily, World of Tomorrow';
	var quoteElement = document.createElement('p');
	var attributionElement = document.createElement('span');
	quoteElement.appendChild(document.createTextNode(myQuote));
	attributionElement.appendChild(document.createTextNode(myAttribution));
	quoteElement.appendChild(attributionElement);
	quoteElement.className = 'quote';
	attributionElement.className = 'attribution';
	document.body.appendChild(quoteElement);
}

function printDom(someElement, numDashes) {
	someElement.addEventListener('click', function(){
		alert(someElement.tagName);
	});
	
	var myString = someElement.tagName;
	var children = someElement.childNodes;
	
	if (someElement.nodeType == 1) {
		numDashes++;
	}
	
	for (var d = 0; d < numDashes; d++) {
		myString = '-' + myString;
	}
	
	for (var i = 0; i < children.length; i++) {
		if (children[i].tagName) {
			myString += '\n' + printDom(children[i], numDashes);	
		}
	}
	
	return myString;	
}