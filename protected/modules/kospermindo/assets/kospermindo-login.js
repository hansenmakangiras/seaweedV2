/**
 *    Neon Login Script
 *
 *    Developed by Arlind Nushi - www.laborator.co
 */

var kospermindoLogin = kospermindoLogin || {};

(function ($, window, undefined) {
    "use strict";

    $(document).ready(function () {
        kospermindoLogin.$container = $("#form_login");


        // Login Form & Validation
        kospermindoLogin.$container.validate({
            rules: {
                username: {
                    required: true
                },

                password: {
                    required: true
                },

            },

            highlight: function (element) {
                $(element).closest('.input-group').addClass('validate-has-error');
            },


            unhighlight: function (element) {
                $(element).closest('.input-group').removeClass('validate-has-error');
            },

            submitHandler: function (ev) {
                /*
                 Updated on v1.1.4
                 Login form now processes the login data, here is the file: data/sample-login-form.php
                 */

                $(".login-page").addClass('logging-in'); // This will hide the login form and init the progress bar

                // Hide Errors
                $(".form-login-error").slideUp('fast');

                // We will wait till the transition ends
                setTimeout(function () {
                    var random_pct = 25 + Math.round(Math.random() * 30);

                    // The form data are subbmitted, we can forward the progress to 70%
                    kospermindoLogin.setPercentage(40 + random_pct);

                    // Send data to the server
                    $.ajax({
                        url: baseurl + '/kospermindo/login',
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            username: $("input#username").val(),
                            password: $("input#password").val(),
                            rememberMe: $("input#rememberMe").val()
                        },
                        error: function () {
                            //kospermindoLogin.setPercentage(100);
                            //setTimeout(function () {
                                // var redirect_url = baseurl;
                                // if (response.redirect_url && response.redirect_url.length) {
                                //     console.log(redirect_url);
                                //     redirect_url = response.redirect_url;
                                // }
                                window.location.href = '/kospermindo';
                                //$(".login-page").removeClass('logging-in');
                                //$(".form-login-error #pesan").text('Sorry, an error has occurred.');
                                //kospermindoLogin.resetProgressBar(true);
                            //}, 400);
                        },
                        success: function (response) {
                            // Login status [success|invalid]
                            var login_status = response.login_status;

                            // Form is fully completed, we update the percentage
                            kospermindoLogin.setPercentage(100);

                            // We will give some time for the animation to finish, then execute the following procedures
                            setTimeout(function () {
                                // If login is invalid, we store the
                                if (login_status === 'invalid') {
                                    $(".login-page").removeClass('logging-in');
                                    $(".form-login-error #pesan").text(response.pesan);
                                    // $(".form-login #pesan").text(response.pesan);
                                    kospermindoLogin.resetProgressBar(true);
                                }else if (login_status === 'success') {
                                    // Redirect to login page
                                    setTimeout(function () {
                                        var redirect_url = baseurl;
                                        if (response.redirect_url && response.redirect_url.length) {
                                            redirect_url = response.redirect_url;
                                        }
                                    }, 400);
                                }

                            }, 500);
                        }
                    });


                }, 400);
            }
        });


        // Lockscreen & Validation
        var is_lockscreen = $(".login-page").hasClass('is-lockscreen');

        if (is_lockscreen) {
            kospermindoLogin.$container = $("#form_lockscreen");
            kospermindoLogin.$ls_thumb = kospermindoLogin.$container.find('.lockscreen-thumb');

            kospermindoLogin.$container.validate({
                rules: {

                    password: {
                        required: true
                    },

                },

                highlight: function (element) {
                    $(element).closest('.input-group').addClass('validate-has-error');
                },


                unhighlight: function (element) {
                    $(element).closest('.input-group').removeClass('validate-has-error');
                },

                submitHandler: function (ev) {
                    /*
                     Demo Purpose Only

                     Here you can handle the page login, currently it does not process anything, just fills the loader.
                     */

                    $(".login-page").addClass('logging-in-lockscreen'); // This will hide the login form and init the progress bar

                    // We will wait till the transition ends
                    setTimeout(function () {
                        var random_pct = 25 + Math.round(Math.random() * 30);

                        kospermindoLogin.setPercentage(random_pct, function () {
                            // Just an example, this is phase 1
                            // Do some stuff...

                            // After 0.77s second we will execute the next phase
                            setTimeout(function () {
                                kospermindoLogin.setPercentage(100, function () {
                                    // Just an example, this is phase 2
                                    // Do some other stuff...

                                    // Redirect to the page
                                    setTimeout("window.location.href = '../../'", 600);
                                }, 2);

                            }, 820);
                        });

                    }, 650);
                }
            });
        }
        // Login Form Setup
        kospermindoLogin.$body = $(".login-page");
        kospermindoLogin.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
        kospermindoLogin.$login_progressbar = kospermindoLogin.$body.find(".login-progressbar div");

        kospermindoLogin.$login_progressbar_indicator.html('0%');

        if (kospermindoLogin.$body.hasClass('login-form-fall')) {
            var focus_set = false;

            setTimeout(function () {
                kospermindoLogin.$body.addClass('login-form-fall-init');
                setTimeout(function () {
                    if (!focus_set) {
                        kospermindoLogin.$container.find('input:first').focus();
                        focus_set = true;
                    }

                }, 550);

            }, 0);
        }
        else {
            kospermindoLogin.$container.find('input:first').focus();
        }

        // Focus Class
        kospermindoLogin.$container.find('.form-control').each(function (i, el) {
            var $this = $(el),
                $group = $this.closest('.input-group');

            $this.prev('.input-group-addon').click(function () {
                $this.focus();
            });

            $this.on({
                focus: function () {
                    $group.addClass('focused');
                },

                blur: function () {
                    $group.removeClass('focused');
                }
            });
        });

        // Functions
        $.extend(kospermindoLogin, {
            setPercentage: function (pct, callback) {
                pct = parseInt(pct / 100 * 100, 10) + '%';

                // Lockscreen
                if (is_lockscreen) {
                    kospermindoLogin.$lockscreen_progress_indicator.html(pct);

                    var o = {
                        pct: currentProgress
                    };

                    TweenMax.to(o, .7, {
                        pct: parseInt(pct, 10),
                        roundProps: ["pct"],
                        ease: Sine.easeOut,
                        onUpdate: function () {
                            kospermindoLogin.$lockscreen_progress_indicator.html(o.pct + '%');
                            drawProgress(parseInt(o.pct, 10) / 100);
                        },
                        onComplete: callback
                    });
                    return;
                }

                // Normal Login
                kospermindoLogin.$login_progressbar_indicator.html(pct);
                kospermindoLogin.$login_progressbar.width(pct);

                var o = {
                    pct: parseInt(kospermindoLogin.$login_progressbar.width() / kospermindoLogin.$login_progressbar.parent().width() * 100, 10)
                };

                TweenMax.to(o, .7, {
                    pct: parseInt(pct, 10),
                    roundProps: ["pct"],
                    ease: Sine.easeOut,
                    onUpdate: function () {
                        kospermindoLogin.$login_progressbar_indicator.html(o.pct + '%');
                    },
                    onComplete: callback
                });
            },

            resetProgressBar: function (display_errors) {
                TweenMax.set(kospermindoLogin.$container, {css: {opacity: 0}});

                setTimeout(function () {
                    TweenMax.to(kospermindoLogin.$container, .6, {
                        css: {opacity: 1}, onComplete: function () {
                            kospermindoLogin.$container.attr('style', '');
                        }
                    });

                    kospermindoLogin.$login_progressbar_indicator.html('0%');
                    kospermindoLogin.$login_progressbar.width(0);

                    if (display_errors) {
                        var $errors_container = $(".form-login-error");

                        $errors_container.show();
                        var height = $errors_container.outerHeight();

                        $errors_container.css({
                            height: 0
                        });

                        TweenMax.to($errors_container, .45, {
                            css: {height: height},
                            onComplete: function () {
                                $errors_container.css({height: 'auto'});
                            }
                        });
                        // Reset password fields
                        kospermindoLogin.$container.find('input[type="password"]').val('');
                    }

                }, 400);

                setTimeout(function () {
                    var $errors_container = $(".form-login-error");
                    $errors_container.hide("slow");
                }, 2000);
            }
        });


        // Lockscreen Create Canvas
        if (is_lockscreen) {
            kospermindoLogin.$lockscreen_progress_canvas = $('<canvas></canvas>');
            kospermindoLogin.$lockscreen_progress_indicator = kospermindoLogin.$container.find('.lockscreen-progress-indicator');

            kospermindoLogin.$lockscreen_progress_canvas.appendTo(kospermindoLogin.$ls_thumb);

            var thumb_size = kospermindoLogin.$ls_thumb.width();

            kospermindoLogin.$lockscreen_progress_canvas.attr({
                width: thumb_size,
                height: thumb_size
            });


            kospermindoLogin.lockscreen_progress_canvas = kospermindoLogin.$lockscreen_progress_canvas.get(0);

            // Create Progress Circle
            var bg = kospermindoLogin.lockscreen_progress_canvas,
                ctx = bg.getContext('2d'),
                imd = null,
                circ = Math.PI * 2,
                quart = Math.PI / 2,
                currentProgress = 0;

            ctx.beginPath();
            ctx.strokeStyle = '#eb7067';
            ctx.lineCap = 'square';
            ctx.closePath();
            ctx.fill();
            ctx.lineWidth = 3.0;

            imd = ctx.getImageData(0, 0, thumb_size, thumb_size);

            var drawProgress = function (current) {
                ctx.putImageData(imd, 0, 0);
                ctx.beginPath();
                ctx.arc(thumb_size / 2, thumb_size / 2, 70, -(quart), ((circ) * current) - quart, false);
                ctx.stroke();

                currentProgress = current * 100;
            };
            drawProgress(0 / 100);


            kospermindoLogin.$lockscreen_progress_indicator.html('0%');

            ctx.restore();
        }

    });

})(jQuery, window);