var timesClicked = 0;

$(document).ready(function () {
	$('#coverart').on('click', function () {
		$.ajax({
			url: 'lab4.json',
			dataType: 'json',
			success: parseJson,
			error: loadFail
		})
		.then(function () {
			timesClicked++;
		});
	});
});

function loadFail(err) {
	console.log('Failed to parse JSON');
}

function parseJson(document) {
	var currentSong = document.playlist[timesClicked % 6];
	
	var coverArtUrl = currentSong.album.coverArtUrl;
	var title = currentSong.songName;
	var artist = '<a href="' + currentSong.artist.url + '">' + currentSong.artist.name + '</a>';
	var album = '<a href="' + currentSong.album.url + '">' + currentSong.album.name + '</a>';
	var date = new Date(currentSong.date.year, currentSong.date.month, currentSong.date.day).toDateString().slice(4);
	var genres = '';
	
	for (var genreNum in currentSong.genres) {
		genres += '<li>' + currentSong.genres[genreNum] + '</li>';
	}
	
	$('#coverart').attr('src', coverArtUrl);
	$('#title').html(title);
	$('#artist').html(artist);
	$('#album').html(album);
	$('#date').html(date);
	$('#genres').html(genres);
}