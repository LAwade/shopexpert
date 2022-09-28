$(function () {
    $('.radio-custom').ready(function () {
        let server = $('#selectServer').val()
        request(server, $('.radio-custom').val(), $("#select_teamspeak").attr('name'))
    })
    
    $('.radio-custom').change(function () {
        let server = $('#selectServer').val()
        request(server, $(this).val(), $("#select_teamspeak").attr('name'))
        cleanValue(["client_unique_identifier","ip_cliente"])
    })
    
    $('#select_teamspeak').change(function(){
        let server = $('#selectServer').val()
        let select_name = $("#select_teamspeak").attr('name');
        request(server, $('.radio-custom').val(), select_name, (select_name == 'groupclient' ? true: false))
    })
    
    $('#template').ready(function () {
        let data_option = $("#template option").data('option')
        change_select_template(data_option)
    })
    
    $('#template').change(function () {
        let data_option = $(this).find(':selected').attr('data-option')
        change_select_template(data_option)
    })
})

const getURL = function(){
    return window.location.origin;
}

const request = function (request, serverquery, teamspeak) {
    $.ajax({
        url: getURL() + "/" + request,
        type: 'POST',
        data: {serverquer: serverquery, teamspeak: teamspeak},
        dataType: 'json'
    }).always(function (data) {
        JSON.parse(data.trim())
    })
}

