var Exment;
(function (Exment) {
    class NotifyNavbarEvent {
        /**
         * Call only once. It's $(document).on event.
         */
        static AddEventOnce() {
            if ($('.navbar-notify').length == 0) {
                return;
            }
            NotifyNavbarEvent.notifyNavbar();
            $(document).on('pjax:complete', function (event) {
                NotifyNavbarEvent.notifyNavbar();
            });
        }
        /**
         * toggle right-top help link and color
         */
        static notifyNavbar() {
            if (NotifyNavbarEvent.timeout_id !== null) {
                clearTimeout(NotifyNavbarEvent.timeout_id);
                NotifyNavbarEvent.timeout_id = null;
            }
            $.ajax({
                url: admin_url(URLJoin('webapi', 'notifyPage')),
                dataType: "json",
                type: "GET",
                success: function (data) {
                    NotifyNavbarEvent.timeout_id = setTimeout(function () {
                        NotifyNavbarEvent.notifyNavbar();
                    }, 60000);
                    $('.navbar-notify ul.menu').empty();
                    $('.container-notify .label-danger').remove();
                    if (data.count > 0) {
                        $('.container-notify').append('<span class="label label-danger">' + data.count + '</span>');
                        for (let i = 0; i < data.items.length; i++) {
                            let d = data.items[i];
                            const isNew = $.inArray(d.id, this.notify_navbar_ids) === -1;
                            let li = $('<li/>', {
                                html: $('<a/>', {
                                    href: hasValue(d.href) ? d.href : 'javascript:void(0);',
                                    html: [
                                        $('<p/>', {
                                            html: [
                                                $('<i/>', {
                                                    'class': 'fa ' + d.icon,
                                                }),
                                                $('<span></span>', {
                                                    'text': d.table_view_name,
                                                }),
                                            ],
                                            'class': 'search-item-icon',
                                            'style': hasValue(d.color) ? 'background-color:' + d.color : null
                                        }),
                                        $('<span/>', {
                                            'text': d.label,
                                        }),
                                    ],
                                }),
                            });
                            $('.navbar-notify ul.menu').append(li);
                        }
                    }
                    else {
                        let li = $('<li/>', {
                            text: data.noItemMessage,
                            'class': 'text-center',
                            style: 'padding:7px;'
                        });
                        $('.navbar-notify ul.menu').append(li);
                    }
                },
            });
        }
    }
    Exment.NotifyNavbarEvent = NotifyNavbarEvent;
})(Exment || (Exment = {}));
$(function () {
    Exment.NotifyNavbarEvent.AddEventOnce();
});
