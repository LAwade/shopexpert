$(function () {
    $("input[type='file']").change(function(){
        nameFileUpload()
    })
})

const nameFileUpload = function () {
    const id = $("input[type='file']").attr('id')
    $("label[for=" + id + "]").text($('#' + id)[0].files[0].name)
}