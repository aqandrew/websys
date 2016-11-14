$(document).ready(function () {
	$.ajax({
		url: 'resources/detail.xml',
		dataType: 'xml',
		success: parseXml,
		error: loadFail
	});
});

function loadFail () {
	alert('Failed to read XML file!');
}

function parseXml(document) {
	$(document).find('semester-project').each(function() {
		let projectUrl = $(this).find('url').text().trim();
		let projectName = $(this).find('name').text().trim();
		let projectDescription = $(this).find('description').text().trim();
		
		$('#semester-project').append(
			'<li><a href="' + projectUrl + '">' + projectName + '</a> | ' + projectDescription + '</li>'
		);
	});
	
	$(document).find('lab').each(function () {
		let labUrl = $(this).find('url').text().trim();
		let labName = $(this).find('name').text().trim();
		let labDescription = $(this).find('description').text().trim();
		
		$('#labs').append(
			'<li><a href="' + labUrl + '">' + labName + '</a> | ' + labDescription + '</li>'
		);
	});
	
	$(document).find('homework').each(function () {
		let homeworkUrl = $(this).find('url').text().trim();
		let homeworkName = $(this).find('name').text().trim();
		let homeworkDescription = $(this).find('description').text().trim();
		
		$('#homework').append(
			'<li><a href="' + homeworkUrl + '">' + homeworkName + '</a> | ' + homeworkDescription + '</li>'
		);
	});
	
	$(document).find('classwork').each(function () {
		let classworkUrl = $(this).find('url').text().trim();
		let classworkDescription = $(this).find('description').text().trim();
		let classworkName = $(this).find('name').text().trim();
																		 
		$('#classwork').append(
			'<li><a href="' + classworkUrl + '">' + classworkName + '</a> | ' + classworkDescription + '</li>'
		);
	});
}