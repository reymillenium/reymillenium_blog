/* Forma Recomendada */
$(function () {

    //Asignamos los eventos comunes a los componente html de toda la aplicación web
    asignarEventos();

});

//Para la carga de la pagina
//window.onload = function () {
//
//    //Asignamos los eventos a los componente html
//    asignarEventos();
//
//};

// Asigno las funciones para cada evento común, de cada componente
function asignarEventos() {
//    alertify.alert(document.URL);

    /*------------------------------------------------------------------------------------------------------------------
     --> *** Definition of the events common for all the Web Site pages *** <--  
     -----------------------------------------------------------------------------------------------------------------*/

    // Borro la cookie div_advanced_search si no es la página de búsqueda (evitar show de accordion cuando se viene de otra página)
    deleteCookie_div_advanced_search_IfNotSearchPage();

    /*------------------------------------------------------------------------------------------------------------------
     -->  Páginas de formularios  <--  
     -----------------------------------------------------------------------------------------------------------------*/

    // Evento keypress en los input:text del teléfono del usuario
    $("input:text#txt_user_phone").on("keypress", isNumberKey);

    // * Permite que al menos un checkbox esté marcado antes de poder buscar *
    //
    // Defino una variable atada a los checboxes
    var checkboxes = $("div#div_advanced_search input[type='checkbox']");

    // Defino una variable atada al botón de búsqueda, que es de tipo submit
    var submitButt = $("button[type='submit']#btn_search");

    // Deshabilito el botón de búsqueda si al menos un checkbox no está marcado
    checkboxes.click(function () {
        submitButt.attr("disabled", !checkboxes.is(":checked"));
    });

    $('#fl_image').filestyle({
        // Cambia de lugar el botón (lo paso hacia la izquierda)
        buttonBefore: true,
        // Especifica el tamaño pequeño
        size: 'sm',
        // Defino el texto del botón
        text: 'Archivo',

        // Defino un ícono para el botón (De Awesomeicon en este caso)
        htmlIcon: '<span class="fa fa-folder"></span> ',
        
        // Defino un placeholder
        'placeholder': 'Escoja una imagen'
    }
    );



















    $('#input01').filestyle()
    $('#input001').filestyle({
        'placeholder': 'Placeholder test'
    });
    $('#input02').filestyle({
        text: 'My filestyle',
        dragdrop: false
    });

    $('#input03').filestyle({
        badge: true,
        input: false,
        btnClass: 'btn-primary',
        htmlIcon: '<span class="oi oi-folder"></span> '
    });

    $('#input04').filestyle({
        htmlIcon: '<span class="oi oi-folder"></span> ',
        text: ''
    });

    $('#input05').filestyle({
        btnClass: 'btn-outline-primary'
    });

    $('#input06').filestyle({
        onChange: function (param) {
            console.log(param)
            alert(param);
        }
    });

    $('#input08').filestyle({
        text: ' File',
        btnClass: 'btn-success'
    });

    $('#clear').click(function () {
        $('#input08').filestyle('clear');
    });

    $('#input09').filestyle({
        text: 'File',
        btnClass: 'btn-primary'
    });

    $('#toggleInput').click(function () {
        var fs = $('#input09');
        if (fs.filestyle('input'))
            fs.filestyle('input', false);
        else
            fs.filestyle('input', true);
    });

    $('#input11').filestyle({
        text: 'Multiple',
        btnClass: 'btn-danger'
    });

    $('#input13').filestyle({
        disabled: true
    });

    $('#input14').filestyle({
        buttonBefore: true
    });

    $('#fl_image').filestyle({
        buttonBefore: true
    });
    $('#input15').filestyle({
        size: 'lg'
    });
    $('#input16').filestyle({
        size: 'sm'
    });

// nultiple initialize
    $('.test').filestyle({
        btnClass: 'btn-primary'
    });

    $('#countRed').on('click', function () {
        $('#input03').filestyle('badgeName', 'badge-danger');
    });

    $('#countToggle').on('click', function () {
        if ($('#input03').filestyle('badge'))
            $('#input03').filestyle('badge', false);
        else
            $('#input03').filestyle('badge', true);
    });
}

/*----------------------------------------------------------------------------------------------------------------------
 --> *** Programming of common functions for all the Web Site pages *** <--  
 ---------------------------------------------------------------------------------------------------------------------*/

// Impide el despliegue del accordion cuando se busque desde otra página (persistencia de la cookie div_advanced_search)
function deleteCookie_div_advanced_search_IfNotSearchPage() {


    // Verifico que se trate de la página de búsqueda o no
    if (document.URL.substr(document.URL.length - 11) != "search_page") {

        // Defino una variable enlazada a una cookie
        var collapseItem = localStorage.getItem('div_advanced_search');

        // Verifico si está o no la cookie almacenada
        if (collapseItem) { // Si está la cookie guardada (ya se pulsó el enlace antes para abrirlo)

            // Borro la cookie
            localStorage.removeItem('div_advanced_search');

        }

    }

}

/*----------------------------------------------------------------------------------------------------------------------
 --> *** Programming of the functions for Specific Web Site pages *** <--  
 ---------------------------------------------------------------------------------------------------------------------*/

//ok
function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault)
            theEvent.preventDefault();
    }
}

//ok
function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if (key < 48 || key > 57) {
        return false;
    } else {
        return true;
    }
}

// OK. Utilizado
function isNumberKey(evt) {

    var charCode = (evt.which) ? evt.which : event.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        //override defaults
//        alertify.defaults.transition = "pulse";
        alertify.defaults.transition = "slide";
//        alertify.defaults.theme.ok = "btn btn-primary";
//        alertify.defaults.theme.cancel = "btn btn-danger";
//        alertify.defaults.theme.input = "form-control";

        alertify.alert('Error en el formato del teléfono', 'Solo pueden teclearse números');
        //show the dialog
        //alertify.YoutubeDialog('GODhPuM5cEE').set({frameless: false});
        return false;
    }

    return true;
}


// Muestra el caret y lo quito sin necesida de darle click (por si lo necesito luego)
function showUnorderedListHover() {
//    alert('test showUnorderedListHover');
//    alertify.alert('test showUnorderedListHover');

    /* Disparo el evento click del enlace con clase dropdown-toggle, para que se mmuestre el ul en el evento mouseover (no en el click) */

    /* Modo inicial de invocar el click. Funciona solo cuando se ejecuta una función anónima en el evento hover */
    // $('.dropdown-toggle', this).trigger('click');
//    $('.dropdown-toggle', 'li.dropdown').trigger('click');

    /* Cambio la figura del caret en el b, de abajo hacia arriba */
//    $('li.dropdown a b.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-up');

}

function hideUnorderedListMouseLeave() {
//    alert('test hideUnorderedListMouseLeave');

    /* Cambio la figura del caret en el b, de arriba hacia abajo */
//    $('li.dropdown a b.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');

    /* Quito el focus del enlace, para que se repliegue la linea inferior */
//    $('#a_short_codes').blur();

}

$('#input14').filestyle({
    buttonBefore: true
});


// Defiition of YoutubeDialog and dialog for the alertify library
alertify.YoutubeDialog || alertify.dialog('YoutubeDialog', function () {
    var iframe;
    return {
        // dialog constructor function, this will be called when the user calls alertify.YoutubeDialog(videoId)
        main: function (videoId) {
            //set the videoId setting and return current instance for chaining.
            return this.set({
                'videoId': videoId
            });
        },
        // we only want to override two options (padding and overflow).
        setup: function () {
            return {
                options: {
                    //disable both padding and overflow control.
                    padding: !1,
                    overflow: !1,
                }
            };
        },
        // This will be called once the DOM is ready and will never be invoked again.
        // Here we create the iframe to embed the video.
        build: function () {
            // create the iframe element
            iframe = document.createElement('iframe');
            iframe.frameBorder = "no";
            iframe.width = "100%";
            iframe.height = "100%";
            // add it to the dialog
            this.elements.content.appendChild(iframe);

            //give the dialog initial height (half the screen height).
            this.elements.body.style.minHeight = screen.height * .5 + 'px';
        },
        // dialog custom settings
        settings: {
            videoId: undefined
        },
        // listen and respond to changes in dialog settings.
        settingUpdated: function (key, oldValue, newValue) {
            switch (key) {
                case 'videoId':
                    iframe.src = "https://www.youtube.com/embed/" + newValue + "?enablejsapi=1";
                    break;
            }
        },
        // listen to internal dialog events.
        hooks: {
            // triggered when the dialog is closed, this is seperate from user defined onclose
            onclose: function () {
                iframe.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
            },
            // triggered when a dialog option gets update.
            // warning! this will not be triggered for settings updates.
            onupdate: function (option, oldValue, newValue) {
                switch (option) {
                    case 'resizable':
                        if (newValue) {
                            this.elements.content.removeAttribute('style');
                            iframe && iframe.removeAttribute('style');
                        } else {
                            this.elements.content.style.minHeight = 'inherit';
                            iframe && (iframe.style.minHeight = 'inherit');
                        }
                        break;
                }
            }
        }
    };
});


