$(document).ready(function() {
    // Import Movies
    $('#importMovies').click(function() {
        $('.overlay').fadeIn();
        $('.sk-wandering-cubes').fadeIn();
        var provaider_id = $('#tmdb').val();
        var path = $(location).attr('pathname');

        if ($('#type').val() == 'movies') {
            var url = path.replace("/movies/create", "") + '/movies-data/tmdb/' + provaider_id;

            $.ajax({
                type: "POST",
                url: url,
                headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    $('#title').val(data.original_title);
                    var genres = $.map(data.genres, function(value, index) {
                        return [value.name];
                    });
                    $('#genres').val(genres.join(', '));
                    $('#overview').val(data.overview);
                    $('#poster').val(data.poster_path);
                    $('.overlay').fadeOut();
                    $('.sk-wandering-cubes').fadeOut();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                   console.log(xhr.status);
                   console.log(thrownError);
               }
            });
        }

        if ($('#type').val() == 'tv') {
            var url = path.replace("/movies/create", "") + '/tv-data/tmdb/' + provaider_id;

            $.ajax({
                type: "POST",
                url: url,
                headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    $('#title').val(data.name);
                    $('.overlay').fadeOut();
                    $('.sk-wandering-cubes').fadeOut();

                    console.log(data.name);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                   console.log(xhr.status);
                   console.log(thrownError);
               }
            });
        }
    });

    // Image Preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image__preview').prop('src', e.target.result).show().addClass('selected');
            }
            reader.readAsDataURL(input.files[0]);
            $('#image__preview').show();
        }
    }

    $("#image").change(function() {
        $('.imagePreview').append('<img id="image__preview">');
        readURL(this);
        $('#image__preview').show();
    });

    // Import Persons
    $('#importPerson').click(function() {
        $('.overlay').fadeIn();
        $('.sk-wandering-cubes').fadeIn();
        var provaider_id = $('#tmdb').val();
        var path = $(location).attr('pathname');
        var url = path.replace("/persons/create", "") + '/person-data/tmdb/' + provaider_id;

            $.ajax({
                type: "POST",
                url: url,
                headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                dataType: "json",
                data: $(this).serialize(),
                success: function(data) {
                    $('#name').val(data['name']);
                    $('#biography').val(data['biography']);
                    $('#image').val(data['profile_path']);
                    $('#birth_date').val(data['birthday']);
                    $('#birth_place').val(data['place_of_birth']);
                    if (data['gender'] == 0) {
                            $('#sex').val('-');
                        }

                        if (data['gender'] == 1) {
                            $('#sex').val('Female');
                        }

                        if (data['gender'] == 2) {
                            $('#sex').val('Male');
                        }
                    $('.overlay').fadeOut();
                    $('.sk-wandering-cubes').fadeOut();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                   console.log(xhr.status);
                   console.log(thrownError);
               }
            });
    });
});