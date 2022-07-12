/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ?
        "" :
        decodeURIComponent(results[1].replace(/\+/g, " "));
}

var cigosidad = [];
var Num_Cigosidad = [];
var colorCi = [];
var acmg = [];
var Num_Acmg = [];
var colorA = [];
var efecto = [];
var Num_Efecto = [];
var colorEf = [];
$(document).ready(function() {
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: {
            metodo: "getGen",
            id: getParameterByName("id"),
        },
        type: "post",
        dataType: "xml",
        beforeSend: function() {},
        success: function(xml) {
            $(xml)
                .find("response")
                .each(function() {
                    $(this)
                        .find("registro")
                        .each(function() {
                            if ($(this).text() != "NOEXITOSO") {
                                $("#gen").text("" + $(this).attr("Num_Gen") + "");
                            } else {
                                bootbox.alert({
                                    message: "",
                                    title: "Alerta",
                                    callback: function() {
                                        window.location = "./busqueda.php";
                                    },
                                    buttons: {
                                        success: {
                                            label: "Ok",
                                            className: "card-color",
                                            callback: function() {},
                                        },
                                    },
                                });
                                return false;
                            }
                        });
                });
        },
    });
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: {
            metodo: "getSNP1",
            id: getParameterByName("id"),
        },
        type: "post",
        dataType: "xml",
        beforeSend: function() {},
        success: function(xml) {
            $(xml)
                .find("response")
                .each(function() {
                    $(this)
                        .find("registro")
                        .each(function() {
                            if ($(this).text() != "NOEXITOSO") {
                                $("#snp").text("" + $(this).attr("Num_IDdbSNP") + "");
                            } else {
                                bootbox.alert({
                                    message: "",
                                    title: "Alerta",
                                    callback: function() {
                                        window.location = "./busqueda.php";
                                    },
                                    buttons: {
                                        success: {
                                            label: "Ok",
                                            className: "card-color",
                                            callback: function() {},
                                        },
                                    },
                                });
                                return false;
                            }
                        });
                });
        },
    });

    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: {
            metodo: "getProteina1",
            id: getParameterByName("id"),
        },
        type: "post",
        dataType: "xml",
        beforeSend: function() {},
        success: function(xml) {
            $(xml)
                .find("response")
                .each(function() {
                    $(this)
                        .find("registro")
                        .each(function() {
                            if ($(this).text() != "NOEXITOSO") {
                                $("#proteina").text(
                                    "" + $(this).attr("Num_VarianteProteina") + ""
                                );
                            } else {
                                bootbox.alert({
                                    message: "",
                                    title: "Alerta",
                                    callback: function() {
                                        window.location = "./busqueda.php";
                                    },
                                    buttons: {
                                        success: {
                                            label: "Ok",
                                            className: "card-color",
                                            callback: function() {},
                                        },
                                    },
                                });
                                return false;
                            }
                        });
                });
        },
    });
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: {
            metodo: "getTranscripto1",
            id: getParameterByName("id"),
        },
        type: "post",
        dataType: "xml",
        beforeSend: function() {},
        success: function(xml) {
            $(xml)
                .find("response")
                .each(function() {
                    $(this)
                        .find("registro")
                        .each(function() {
                            if ($(this).text() != "NOEXITOSO") {
                                $("#transcrip").text(
                                    "" + $(this).attr("VarianteTranscripto1") + ""
                                );
                            } else {
                                bootbox.alert({
                                    message: "",
                                    title: "Alerta",
                                    callback: function() {
                                        window.location = "./busqueda.php";
                                    },
                                    buttons: {
                                        success: {
                                            label: "Ok",
                                            className: "card-color",
                                            callback: function() {},
                                        },
                                    },
                                });
                                return false;
                            }
                        });
                });
        },
    });

    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: {
            metodo: "getGQ1",
            id: getParameterByName("id"),
        },
        type: "post",
        dataType: "xml",
        beforeSend: function() {},
        success: function(xml) {
            $(xml)
                .find("response")
                .each(function() {
                    $(this)
                        .find("registro")
                        .each(function() {
                            if ($(this).text() != "NOEXITOSO") {
                                $("#calidad").text("" + $(this).attr("Num_GQ") + "");
                            } else {
                                bootbox.alert({
                                    message: "",
                                    title: "Alerta",
                                    callback: function() {
                                        window.location = "./busqueda.php";
                                    },
                                    buttons: {
                                        success: {
                                            label: "Ok",
                                            className: "card-color",
                                            callback: function() {},
                                        },
                                    },
                                });
                                return false;
                            }
                        });
                });
        },
    });

    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: {
            metodo: "getACMG1",
            id: getParameterByName("id"),
        },
        type: "post",
        dataType: "xml",
        beforeSend: function () {

        },
        success: function (xml) {
            $(xml).find("response").each(function () {

                var n = 0;
                $(this).find("registro").each(function () {
                    if ($(this).text() != 'NOEXITOSO') {
                        acmg.push($(this).attr('ACMG'));
                        Num_Acmg.push($(this).attr('Num_ACMG'));
                        if (n % 2 == 0) {
                            colorA.push('#201C42');
                        } else {
                            colorA.push('#E50850');
                        }
                    } else {
                        bootbox.alert({
                            message: '',
                            title: "Alerta",
                            callback: function () {
                                window.location = './busqueda.php';
                            },
                            buttons: {
                                "success": {
                                    label: "Ok",
                                    className: "card-color",
                                    callback: function () { }
                                }
                            }});
                        }
                            n = n + 1;
                        });
                });
            var donutChartCanvas = $("#donutChart5").get(0).getContext("2d");
            var donutData = {
                labels: acmg,
                datasets: [{
                    data: Num_Acmg,
                    backgroundColor: colorA,
                }, ],
            };
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var myNewChart = new Chart(donutChartCanvas, {
                type: "doughnut",
                data: donutData,
                options: donutOptions,
            });

            document.getElementById("donutChart5").onclick = function(evt) {
                var activePoints = myNewChart.getElementsAtEvent(evt);

                if (activePoints.length > 0) {
                    //get the internal index of slice in pie chart
                    var clickedElementindex = activePoints[0]["_index"];
                    alert("clickedElementindex " + clickedElementindex);

                    //get specific label by index
                    var label = myNewChart.data.labels[clickedElementindex];
                    alert("label " + label);
                    //get value by index
                    var value = myNewChart.data.datasets[0].data[clickedElementindex];
                    alert("value " + value);
                    /* other stuff that requires slice's label and value */
                }
            };
        },
    });



    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: {
            metodo: "getCigosidad1",
            id: getParameterByName("id"),
        },
        type: "post",
        dataType: "xml",
        beforeSend: function () {

        },
        success: function (xml) {
            $(xml).find("response").each(function () {

                var o = 0;
                $(this).find("registro").each(function () {
                    if ($(this).text() != 'NOEXITOSO') {
                        cigosidad.push($(this).attr('Cigosidad'));
                        Num_Cigosidad.push($(this).attr('Cigosidad1'));
                        if (o % 2 == 0) {
                            colorCi.push('#201C42');
                        } else {
                            colorCi.push('#E50850');
                        }
                    } else {
                        bootbox.alert({
                            message: '',
                            title: "Alerta",
                            callback: function () {
                                window.location = './busqueda.php';
                            },
                            buttons: {
                                "success": {
                                    label: "Ok",
                                    className: "card-color",
                                    callback: function () { }
                                }                            
                            }});
                        }
                            o = o + 1;
                        });
                    
                });
            var donutChartCanvas = $("#donutChart6").get(0).getContext("2d");
            var donutData = {
                labels: cigosidad,
                datasets: [{
                    data: Num_Cigosidad,
                    backgroundColor: colorCi,
                }, ],
            };
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: "doughnut",
                data: donutData,
                options: donutOptions,
            });
        },
    });
    $.ajax({
        url: "../../controller/CapturaInformacionController.php",
        data: {
            metodo: "getEfecto1",
            id: getParameterByName("id"),
        },
        type: "post",
        dataType: "xml",
        beforeSend: function () {

        },
        success: function (xml) {
            $(xml).find("response").each(function () {

                var p = 0;
                $(this).find("registro").each(function () {
                    if ($(this).text() != 'NOEXITOSO') {
                        efecto.push($(this).attr('Efect'));
                        Num_Efecto.push($(this).attr('Num_Efect'));
                        if (p % 2 == 0) {
                            colorEf.push('#201C42');
                        } else {
                            colorEf.push('#E50850');
                        }
                    } else {
                        bootbox.alert({
                            message: '',
                            title: "Alerta",
                            callback: function () {
                                window.location = './busqueda.php';
                            },
                            buttons: {
                                "success": {
                                    label: "Ok",
                                    className: "card-color",
                                    callback: function () { }
                                }                            
                            }});
                        }
                            p = p + 1;
                        });
                });
            var donutChartCanvas = $("#donutChart7").get(0).getContext("2d");
            var donutData = {
                labels: efecto,
                datasets: [{
                    data: Num_Efecto,
                    backgroundColor: colorEf,
                }, ],
            };
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: "doughnut",
                data: donutData,
                options: donutOptions,
            });
        },
    });
});