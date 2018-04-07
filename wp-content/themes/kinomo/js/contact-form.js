$(document).on('ready', function () {

    function form(selector, num) {
        var form = $(selector);
        var firstName = form.find('.js-contact-first-name');
        var lastName = form.find('.js-contact-last-name');
        var company = form.find('.js-contact-company-name');
        var website = form.find('.js-contact-website');
        var email = form.find('.js-contact-email');
        var country = form.find('.js-contact-country');
        var submit = form.find('.js-contact-submit');

        var error = false;

        form.find('.js-tab').on('click', function(){
            form.find('.form__btn').show();
            return false;
        });

        var partnersRadio = form.find('.js-partners-radio');
        partnersRadio.on('click', function () {
            var checked = partnersRadio.find('input[name="partner-describtion"]:checked');
            if (checked.val() === form.find('.js-partners-additional').val()) {
                form.find('.js-contact-partners-details').show();
            } else {
                form.find('.js-contact-partners-details').hide();
                form.find('.js-contact-partners-details').parents('.form-row').find('.form-message').remove();
            }

        });

        var buyerSelect = form.find('.js-buyer-select');
        buyerSelect.on('change', function () {
            if (buyerSelect.val() === 'Other') {
                form.find('.js-contact-buyer-details').show();
            } else {
                form.find('.js-contact-buyer-details').hide();
                form.find('.js-contact-buyer-details').parents('.form-row').find('.form-message').remove();
            }

        });

        var eventRadio = form.find('.js-events-main-radio');
        eventRadio.on('click', function () {
            var checked = eventRadio.find('input[name="rentalflag"]:checked');
            if (checked.val() === form.find('.js-event-additional').val()) {
                form.find('.js-events-additional-select').show();
            } else {
                form.find('.js-events-additional-select').hide();
            }

        });

        var childSelect1 = form.find('.js-events-add-1');
        childSelect1.on('click', function () {
            var checked = childSelect1.find('input[name="eventsagencyflag"]:checked');
            if (checked.val() === 'no') {
                childSelect1.find('.js-events-add-1-error').show();
            } else {
                childSelect1.find('.js-events-add-1-error').hide();
            }
        });


        submit.on('click', function () {
            error = false;
            form.find('form').find('.form-message').remove();
            form.find('.form-error').removeClass('form-error');
            if (!firstName.val().trim()) {
                firstName.parents('.form-row').append(
                    $('<span>').addClass('form-message').text('This field is required.')
                )
                firstName.addClass('form-error');
                error = true;
            }
            if (!lastName.val().trim()) {
                lastName.parents('.form-row').append(
                    $('<span>').addClass('form-message').text('This field is required.')
                )
                lastName.addClass('form-error');
                error = true;
            }
            if (!website.val().trim()) {
                website.parents('.form-row').append(
                    $('<span>').addClass('form-message').text('This field is required.')
                )
                website.addClass('form-error');
                error = true;
            }
            if (!email.val()) {
                email.parents('.form-row').append(
                    $('<span>').addClass('form-message').text('This field is required.')
                )
                email.addClass('form-error');
                error = true;
            }
            else if (!validateEmail(email.val())) {
                email.parents('.form-row').append(
                    $('<span>').addClass('form-message').text('Email is invalid.')
                )
                email.addClass('form-error');
                error = true;
            }
            if (country.parents('.form-row').find('.dropdown-header--placeholder').length) {
                country.parents('.form-row').append(
                    $('<span>').addClass('form-message').text('This field is required.')
                )
                country.addClass('form-error');
                error = true;
            }

            var result = {
                first_name: firstName.val(),
                last_name: lastName.val(),
                company_name: company.val(),
                website: website.val(),
                email: email.val(),
                country: country.val(),
            };

            var additional = {};

            var activeTab = form.find('.js-tab.active');
            var partnerTab = form.find('#partner-' + num);
            var buyerTab = form.find('#buyer-' + num);
            var eventsTab = form.find('#events-' + num);

            if (activeTab.data('id') === partnerTab.attr('id')) {
                var checked = partnersRadio.find('input[name="partner-describtion"]:checked');
                var partnerDetails = form.find('.js-contact-partners-details');

                if (!checked.length){
                    partnerDetails.parents('.form-row').append(
                        $('<span>').addClass('form-message').text('This field is required.')
                    )
                    error = true;
                }
                if (checked.val() === form.find('.js-partners-additional').val()) {
                    if (!partnerDetails.val().trim()) {
                        partnerDetails.parents('.form-row').append(
                            $('<span>').addClass('form-message').text('This field is required.')
                        )
                        error = true;
                    }

                }

                var partnerMessage = form.find('.js-contact-partner-message');
                if (!partnerMessage.val().trim()) {
                    partnerMessage.parents('.form-row').append(
                        $('<span>').addClass('form-message').text('This field is required.')
                    )
                    error = true;
                }

                additional = {
                    tab: 'partners',
                    radio: partnersRadio.find('input[name="partner-describtion"]:checked').val(),
                    message: form.find('.js-contact-partner-message').val(),
                    details: form.find('.js-contact-partner-details').val(),
                }
            } else if (activeTab.data('id') === buyerTab.attr('id')) {
                //company.val(company.val()+'--');
                if (buyerSelect.parents('.form-row').find('.dropdown-header--placeholder').length) {
                    buyerSelect.parents('.form-row').append(
                        $('<span>').addClass('form-message').text('This field is required.')
                    )
                    buyerSelect.addClass('form-error');
                    error = true;
                }

                var buyerOther = form.find('.js-contact-buyer-details');
                if (buyerSelect.val() === 'Other') {
                    if (!buyerOther.val().trim()) {
                        buyerOther.parents('.form-row').append(
                            $('<span>').addClass('form-message').text('This field is required.')
                        )
                        error = true;
                    }
                }

                var buyerMessage = form.find('.js-contact-buyer-message');

                if (!buyerMessage.val().trim()) {
                    buyerMessage.parents('.form-row').append(
                        $('<span>').addClass('form-message').text('This field is required.')
                    )
                    error = true;
                }

                /*var buyerQuantities = form.find('.js-contact-buyer-quantities');

                if (!buyerQuantities.val().trim()) {
                    buyerQuantities.parents('.form-row').append(
                        $('<span>').addClass('form-message').text('This field is required.')
                    )
                    error = true;
                }*/


                additional = {
                    tab: 'buyer',
                    select: buyerSelect.val(),
                    //quantities: buyerQuantities.val(),
                    details: buyerOther.val(),
                    message: buyerMessage.val(),
                }
            } else if (activeTab.data('id') === eventsTab.attr('id')) {
                var mainSelect = form.find('.js-events-main');
                var childSelect1 = form.find('.js-events-add-1');
                var childSelect2 = form.find('.js-events-add-2');

                if (mainSelect.find('input[name="rentalflag"]:checked').val() === 'Yes') {

                } else {
                    var checked = childSelect1.find('input[name="eventsagencyflag"]:checked');
                    if (checked.val() === 'No') {
                        error = true;
                    }

                    checked = childSelect1.find('input[name="eventsagencyflag"]:checked');

                    if (!checked.val()) {
                        error = true;
                        childSelect1.find('.form-row').append(
                            $('<span>').addClass('form-message').text('This field is required.')
                        )
                    }

                    checked = childSelect2.find('input[name="eventsagencyoravcompany"]:checked');

                    if (!checked.val()) {
                        error = true;
                        childSelect2.find('.form-row').append(
                            $('<span>').addClass('form-message').text('This field is required.')
                        )
                    }
                }




                var eventsMessage = form.find('.js-events-message');

                if (!eventsMessage.val().trim()) {
                    eventsMessage.parents('.form-row').append(
                        $('<span>').addClass('form-message').text('This field is required.')
                    )
                    error = true;
                }
                additional = {
                    tab: 'events',
                    q1: eventRadio.find('input[name="partner-describtion"]:checked').val(),
                    q2: childSelect1.find('input[name="eventsagencyflag"]:checked').val(),
                    q3: childSelect2.find('input[name="eventsagencyoravcompany"]:checked').val(),
                    message: eventsMessage.val()
                }
            }

            result = $.extend({}, result, additional);


            if (!company.val().trim()&&((activeTab.data('id') !== buyerTab.attr('id')))) {
                company.parents('.form-row').append(
                    $('<span>').addClass('form-message').text('This field is required.')
                )
                company.addClass('form-error');
                error = true;
            }

            console.log(error);

            if (error) {
                return false;
            }

            // form.find(':input:hidden').not('[type=hidden]').val('');
            form.find('input[name=client-type]').val(form.find('.form__list .js-tab.active').data('type'));

            var partnerTabCode, buyerTabCode, eventsTabCode;

            if (activeTab.data('id') === partnerTab.attr('id')) {
                buyerTabCode = buyerTab.find('.row').detach();
                eventsTabCode = eventsTab.find('.row').detach();
            } else if (activeTab.data('id') === buyerTab.attr('id')) {
                partnerTabCode = partnerTab.find('.row').detach();
                eventsTabCode = eventsTab.find('.row').detach();
            } else if (activeTab.data('id') === eventsTab.attr('id')) {
                buyerTabCode = buyerTab.find('.row').detach();
                partnerTabCode = partnerTab.find('.row').detach();
            }

            var lastActive = activeTab;

            form.addClass('preloader-block').prepend(
                $('<div>').addClass('preloader-block__inner').append(
                    $('<div>').addClass('preloader-block__inner-text').text('Loading')
                )
            );

            var formData = form.find('form').serialize();

            $.ajax({
                type: 'POST',
                url: form.find('form').data('url'),
                data: formData,
                success: function (response) {
                    form.find('.form__body').hide();
                    form.find('._text').html(response);
                    form.find('._label').hide();
                    var position = $("#enquire-now").offset().top;
                    $("HTML, BODY").animate({ scrollTop: position-100 }, 1000);
                },
                error: function () {
                    form.find('.js-form-error').text('Error. Please, try again.');
                    if (lastActive.data('id') === partnerTab.attr('id')) {
                        eventsTab.append(eventsTabCode);
                        buyerTab.append(buyerTabCode);
                    } else if (lastActive.data('id') === buyerTab.attr('id')) {
                        eventsTab.append(eventsTabCode);
                        partnerTab.append(partnerTabCode);
                    } else if (lastActive.data('id') === eventsTab.attr('id')) {
                        partnerTab.append(partnerTabCode);
                        buyerTab.append(buyerTabCode);
                    }
                },
                complete: function (response) {
                    form.removeClass('preloader-block');
                    form.find('.preloader-block__inner').remove();
                    if (lastActive.data('id') === partnerTab.attr('id')) {
                        eventsTab.append(eventsTabCode);
                        buyerTab.append(buyerTabCode);
                    } else if (lastActive.data('id') === buyerTab.attr('id')) {
                        eventsTab.append(eventsTabCode);
                        partnerTab.append(partnerTabCode);
                    } else if (lastActive.data('id') === eventsTab.attr('id')) {
                        partnerTab.append(partnerTabCode);
                        buyerTab.append(buyerTabCode);
                    }
                }
            });

            return false;
        });
    }

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    form('.js-contact-form-2', 2);
    form('.js-contact-form-1', 1);

})

