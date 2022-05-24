/*
$(function() {
    $('#kcaptcha_image').bind('click', function() {
        $.ajax({
            type: 'POST',
            url: g4_path+'/'+g4_bbs+'/kcaptcha_session.php',
            cache: false,
            async: false,
            success: function(text) {
                $('#kcaptcha_image').attr('src', g4_path+'/'+g4_bbs+'/kcaptcha_image.php?t=' + (new Date).getTime());
            }
        });
    })
    .css('cursor', 'pointer')
    .attr('title', '���ڰ� �� �Ⱥ��̽ô� ��� Ŭ���Ͻø� ���ο� ���ڰ� ���ɴϴ�.')
    .attr('width', '120')
    .attr('height', '60')
    .trigger('click');
});
*/

// jQuery�� ����� ���� �Լ��� PLug-in �������� �߰��� �� �ִ�.
$.extend({
    kcaptcha_load: function() {
        $('#kcaptcha_image').bind('click', function() {
            $.ajax({
                type: 'POST',
                url: g4_path+'/'+g4_bbs+'/kcaptcha_session.php',
                cache: false,
                async: false,
                success: function(text) {
                    $('#kcaptcha_image').attr('src', g4_path+'/'+g4_bbs+'/kcaptcha_image.php?t=' + (new Date).getTime());
                }
            });
        })
        .css('cursor', 'pointer')
        .attr('title', '���ڰ� �� �Ⱥ��̽ô� ��� Ŭ���Ͻø� ���ο� ���ڰ� ���ɴϴ�.')
        .attr('width', '120')
        .attr('height', '60');
    },
    kcaptcha_run: function() {
        $.kcaptcha_load();
        $('#kcaptcha_image').trigger("click");
    }
});

$(function() {
    $.kcaptcha_run();
});

// ��µ� ĸí�̹����� Ű���� �Է��� Ű���� ������ ���Ѵ�.
function check_kcaptcha(input_key)
{
    if (typeof(input_key) != 'undefined') {
        var captcha_result = false;
        $.ajax({
            type: 'POST',
            url: g4_path+'/'+g4_bbs+'/kcaptcha_result.php',
            data: {
                'captcha_key': input_key.value 
            },
            cache: false,
            async: false,
            success: function(text) {
                captcha_result = text;
            }
        });

        if (!captcha_result) {
            alert('���ڰ� Ʋ�Ȱų� �Է� Ƚ���� �Ѿ����ϴ�.\n\n�̹����� Ŭ���Ͽ� �ٽ� �Է��� �ֽʽÿ�.');
            input_key.select();
            return false;
        }
    }
    return true;
}