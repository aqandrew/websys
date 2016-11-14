Before any optimization
	2.03 s
	
Part 1
	1.83 s
	
Part 2: Performance Improvements
	- In the first jQuery selector, appending 5000 list elements to the unordered list, select by id only (#foo), instead of "div.bar ul#foo".
		ID is the most efficient CSS selector.
		1.84 s
	
	- Move-refactor this jQuery selection out of the 5000 loop.
		This reduces the number of jQuery calls from 5000 to 1.
		1.74 s
		
	- Get rid of this part of the .ready function entirely, and include all 10000 of the list elements literally in the HTML, instead of appending them through jQuery.
		This eliminates all jQuery.append() calls.
		897.14 ms
		
	- Make the background color lightblue instead of loading a background image.
		Removing the query to a foreign URL makes the background-rendering extremely fast.
		706.40 ms
		
	- Move the CSS to the <head> from the <body>.
		This ensures that styles are applied to elements as they are rendered.
		707.80 ms