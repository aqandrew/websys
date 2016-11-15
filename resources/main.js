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
		
		$('#semester-project-content').append(
			'<div class="col-lg-4 col-lg-offset-2">' +
				'<p><a href="' + projectUrl + '">' + projectName +
				'</a></p>' + '</div>' +
			'<div class="col-lg-4"><p>' +
				projectDescription +
			'</p></div>'
		);
	});
	
	$(document).find('lab').each(function () {
		let labUrl = $(this).find('url').text().trim();
		let labName = $(this).find('name').text().trim();
		let labDescription = $(this).find('description').text().trim();
		
		$('#lab-row').append(
			'<div class="col-sm-4 portfolio-item"><a href="' + labUrl + '"><h2>' + labName + '</h2></a><p>' + labDescription + '</p></div>'
		);
	});
	
	$(document).find('homework').each(function () {
		let homeworkUrl = $(this).find('url').text().trim();
		let homeworkName = $(this).find('name').text().trim();
		let homeworkDescription = $(this).find('description').text().trim();
		
		$('#homework-row').append(
			'<div class="col-lg-6 homework-div"><a href="' + homeworkUrl + '"><h2>' + homeworkName + '</h2></a><p>' + homeworkDescription + '</p></div>'
		);
	});
	
	$(document).find('classwork').each(function () {
		let classworkUrl = $(this).find('url').text().trim();
		let classworkDescription = $(this).find('description').text().trim();
		let classworkName = $(this).find('name').text().trim();
																		 
		$('#classwork-row').append(
			'<div class="col-lg-4"><a href="' + classworkUrl + '"><h2>' + classworkName + '</h2></a><p>' + classworkDescription + '</p></div>'
		);
	});
}