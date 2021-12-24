require('./bootstrap');

$(document).ready(function(){
    // Flash logic
    let alert = $('.alert');
    alert.fadeIn();
    alert.click(function () {
        $(this).fadeOut(function () {
            $(this).remove();
        });
    });


    // Comments logic
    $('.like[src*="fill"]').addClass('active');


    // Comment statistic
    $('.like').click(async function(){
        let commentStat = $(this).parents('.comment').find('.comment_stat');
        let canRate = false;
        let data = {
            'author_id': commentStat.data('author_id'),
            'user_id': $('#note_stat').data('user_id'),
            'comment_id': commentStat.data('comment_id'),
            'type': $(this).data('type')
        };
        // Server change
        await $.ajax({
            url: '/api/comment/stat',
            type: 'GET',
            data: data,
            success: function(){
                canRate = true;
            }
        });

        // Client change
        if (canRate) {
            if (!$(this).hasClass('active')) {
                // Swap
                if ($(this).parent().find('.active').length) {
                    $(this).parent().find('span[data-type="' + $(this).parent().find('.active').data('type') + '"]').text(
                        (parseInt($(this).parent().find('span[data-type="' + $(this).parent().find('.active').data('type') + '"]').text()) - 1)
                    )
                    $(this)
                        .parent()
                        .find('.active')
                        .attr('src', '/images/' + ($(this).parent().find('.active').data('type') === 1 ? '' : 'dis') + 'like.svg')
                        .removeClass('active');
                }
                // Add
                $(this)
                    .addClass('active')
                    .attr('src', '/images/' + ($(this).data('type') === 1 ? '' : 'dis') + 'like-fill.svg');
                $(this).parent().find('span[data-type="' + $(this).data('type') + '"]').text(
                    (parseInt($(this).parent().find('span[data-type="' + $(this).data('type') + '"]').text()) + 1)
                )

            } else {
                // Remove
                $(this)
                    .removeClass('active')
                    .attr('src', '/images/' + ($(this).data('type') === 1 ? '' : 'dis') + 'like.svg');
                $(this).parent().find('span[data-type="' + $(this).data('type') + '"]').text(
                    (parseInt($(this).parent().find('span[data-type="' + $(this).data('type') + '"]').text()) - 1)
                )
            }
        }
    });


    // Open create comment menu
    $('.create_comment').click(function(){
        $('.create-comment__block').slideToggle(100);
    })


    // Save comment
    $('.save-comment').click(async function(){
        let block = $('.create-comment__block');
        block.find('.modal-white').fadeIn();

        let noteStat = $('#note_stat');
        let data = {
            'user_id': noteStat.data('user_id'),
            'note_id': noteStat.data('note_id'),
            'text': $('#text').val(),
            'rate': $('#rate').val(),
        };

        await $.ajax({
            url: '/api/comment/create',
            type: 'GET',
            data: data,
            success: function(data){
                block.find('.modal-white').fadeOut(100);
                block.slideToggle(300);
                let commentData = data[0];
                let date = commentData['created_at'];
                if (date.indexOf(',') > -1)
                    date = date.split(',')[0];
                else
                    date = date.split('T')[0];
                let _item = '<div class="brad-2 comment shadow mb-md-3 p-3 bg-white d-block text-dark text-decoration-none"> <input type="hidden" class="comment_stat" data-comment_id="{comment_id}" data-author_id="{author_id}"> <div class="comment__row d-flex mb-2"> <div class="comment__user carmine"> <img src="/images/author.svg" alt="Author" title="Author"> <span>{author}</span> </div><div class="comment__date"> <img src="/images/schedule.svg" alt="Date" title="Date"> <span>{date}</span> </div><div class="comment__rate"> <div class="rating-stars"> <span style="width:{rate}%;"></span> </div></div></div><div class="comment__text">{text}</div><div class="comment__edit" style="display: none;"> <div class="form-group"> <label class="form-check-label carmine" for="text"> Comment </label> <textarea class="form-control text" name="text">{text}</textarea> </div><div class="form-group"> <label class="form-check-label carmine" for="rate"> Rate </label> <input type="number" value="{rate}" step="0.1" name="rate" min="0" max="5" class="form-control w-auto rate" size="2"> </div><div class="form-group mb-0"> <button type="submit" class="update-comment btn btn-group carmine-bg text-white">Save</button> </div></div><div class="comment_bottom_event d-flex justify-content-between mt-3"> <div class="comment__stat"> <span class="mr-2"> <span class="stat-number" data-type="1">0</span> <img src="/images/like.svg" alt="Likes" title="Likes" class="like mr-2" data-type="1"> <img src="/images/dislike.svg" alt="Dislikes" title="Dislikes" class="like" data-type="0"> <span class="stat-number" data-type="0">0</span> </span> </div><div class="comment__edit"> <div class="edit_event"> <a class="comment_update carmine mr-3">Edit</a> <a class="comment_delete carmine">Delete</a> </div></div></div></div>';
                _item = _item.replaceAll('{comment_id}', commentData['id']);
                _item = _item.replaceAll('{author_id}', commentData['user_id']);
                _item = _item.replaceAll('{author}', data[1]);
                _item = _item.replaceAll('{date}', date);
                _item = _item.replaceAll('{rate}', (parseInt(commentData['rate']) * 20));
                _item = _item.replaceAll('{text}', commentData['text']);
                $('.comments').append($(_item));
            },
            error: async function(){
                block.find('.modal-white').fadeOut(100);
            }
        });
    });


    // Delete comment
    $(document).on('click', '.comment_delete', function(){
        let block = $(this).parents('.comment');
        $.ajax({
            url: '/api/comment/delete/' + $(this).parents('.comment').find('.comment_stat').data('comment_id'),
            type: 'GET',
            success: function(){
                block.slideUp(function(){
                    $(this).remove();
                })
            }
        });
    });


    // Open update comment menu
    $(document).on('click', '.comment_update', function(){
        let block = $(this).parents('.comment');
        block.find('.comment__edit').slideToggle(100);
        block.find('.comment__text').slideToggle(100);
    })


    // Update comment
    $(document).on('click', '.update-comment', function(e){
        let block = $($(e.target).parents('.comment'));
        let data = {
            'text': block.find('.text').val(),
            'rate': block.find('.rate').val(),
            'comment_id': block.find('.comment_stat').data('comment_id'),
            'user_id': block.find('.comment_stat').data('author_id'),
        };
        $.ajax({
            url: '/api/comment/update',
            type: 'GET',
            data: data,
            success: function(data){
                block.find('.comment__text').text(data['text'])
                block.find('.rating-stars span').css('width', (data['rate'] * 20) + '%')
                block.find('.comment__edit').slideToggle(100);
                block.find('.comment__text').slideToggle(100);
            }
        });
    });
    $('input[type=file]').change(function() {
        $('.image-file img').attr('src', window.URL.createObjectURL(this.files[0])).removeClass('d-none');
    })
});

