/**
 * Created by root on 11/19/15.
 */

var searchForm = (function()
{
    var steps = { step1: false, step2: false, step3: false, step4: false }, $form,
        conditions = {$country: 0, $city: 0, $library: 0,
            $book: { $book_form: 0, $book_props:{    $genre:0,$author:0,$title:0     }  }
        },
        suggests = { authorSuggestions: 0, titleSuggestions: 0 } ;

    function init() {
        $form = $('.j-form');

        conditions.$country  = $form.find('.j-country').children().find('select');
        conditions.$city = $form.find('.j-city').children().find('select');
        conditions.$library = $form.find('.j-library').children().find('select');

        conditions.$book.$book_form = $form.find('.j-book');
        conditions.$book.$book_props.$genre = conditions.$book.$book_form.find('.j-info-genre').children().find('select');
        conditions.$book.$book_props.$author = conditions.$book.$book_form.find('.j-info-author').children().find('input');
        conditions.$book.$book_props.$title = conditions.$book.$book_form.find('.j-info-title').children().find('input');
        conditions.$country.change(function() {
            var countryId = conditions.$country.val();

            disableStep(2);
            if(countryId) { setStep(2); }
            if(getStep(1)) {
                var cond = {countryId: countryId};
                $.ajax({
                    method: 'POST',
                    url: window.location.origin+'/city/ajax',
                    data: {conditions: cond}
                }).done(function (data) {
                    if(data && data.success){
                        console.log(data);
                        appendOptions( conditions.$city , formOptions(data.options) );  setStep(2);
                    }else{
                        console.log(data.errors);
                    }
                });
            }
        });
        conditions.$city.change(function(){
            var cityId = conditions.$city.val();
            if(getStep(3) || getStep(4))  {    disableStep(2);  }
            if(cityId)  { setStep(3); }
            if(getStep(3)) {
                var cond = {cityId: cityId};
                $.ajax({
                    method: 'POST',
                    url: window.location.origin+'/library/ajax',
                    data: {conditions: cond}
                }).done(function (data) {
                    if(data && data.success){
                        appendOptions( conditions.$library , formOptions(data.options) );    setStep(4);
                    }else{
                        console.log(data.error());
                    }
                });
            }
        });
        conditions.$library.on('change',function(){
            var libraryId = conditions.$library.val();
            if(getStep(4))  {    disableStep(4);  }
            if(libraryId) { setStep(4); }
            if(getStep(4)) {
                $.ajax({
                    method: 'POST',
                    url: window.location.origin+'/genre/ajax'
                }).done(function (data) {
                    if(data && data.success){
                        appendOptions( conditions.$book.$book_props.$genre , formOptions(data.options) );
                    }else{
                        console.log(data.errors);
                    }
                });
            }
        });
        disableStep(2);
    }
    function appendOptions($selector, options){
        if($selector){
            $selector.empty();
            $selector.append(options);
        }
    }

    function disableStep(stepsCount){
        stepsCount = (stepsCount == undefined || stepsCount == null ) ? 0 : stepsCount-1;
        for(var i = stepsCount ; i < Object.keys(steps).length; i++){
            steps[Object.keys(steps)[i]]=false;
            var cond = conditions[Object.keys(conditions)[i]];
            if( cond instanceof jQuery && cond != 0 && cond != undefined ){
                cond.prop('disabled',true);
            }   else   {
                cond[Object.keys(cond)[0]].find('div').children().find('*').prop('disabled',true);
            }
        }
    }

    function setStep(step){
        step = (step == undefined || step == null ) ? 0 : step-1;
        steps[Object.keys(steps)[step]]=true;
        var cond = conditions[Object.keys(conditions)[step]];
        if( cond instanceof jQuery && cond != 0 && cond != undefined ){
            cond.prop('disabled',false);
        }   else   {
            cond[Object.keys(cond)[0]].find('div').children().find('*').prop('disabled',false);
        }
    }
    function getStep(step){
        return steps[Object.keys(steps)[step-1]];
    }
    function formOptions(data){
        var options ="<option value = '' >Please Select</option>";
        for(key in data){
            options+= "<option value = "+ key +">"+ data[key] +" </option> ";
        }
        return options;
    }
    return {
        init: function () {
            init();
        }
    }
}
)();