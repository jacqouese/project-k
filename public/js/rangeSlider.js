var ranges = document.querySelectorAll('.input-range');
var show = 'nie ważne';

var urlParams = new URLSearchParams(window.location.search);

ranges.forEach((range) => {
  //asign values from url after page refreshes
  var att = range.getAttribute('name');

  if (att == 'sea') {
    if (urlParams.get('sea') != null) {
      range.value = urlParams.get('sea');
    }
  }
  else if (att == 'bike') {
    if (urlParams.get('bike') != null) {
      range.value = urlParams.get('bike');
    }
  }
  else if (att == 'park') {
    if (urlParams.get('park') != null) {
      range.value = urlParams.get('park');
    }
  }
  else if (att == 'playground') {
    if (urlParams.get('playground') != null) {
      range.value = urlParams.get('playground');
    }
  }
  else if (att == 'dogpark') {
    if (urlParams.get('dogpark') != null) {
      range.value = urlParams.get('dogpark');
    }
  }

  var translations = document.querySelector('.slider-translations');
  
  if(range.value < 10) {
    show = translations.getAttribute('one');
  }
  if(range.value > 10) {
    show = translations.getAttribute('two');
  }
  if(range.value > 25) {
    show = translations.getAttribute('three');
  }
  if(range.value > 40) {
    show = translations.getAttribute('four');
  }

  var value = range.parentNode.parentNode.querySelector('.range-value');

  value.innerHTML = show;

  range.addEventListener('input', function(){
    if(this.value < 10) {
      show = translations.getAttribute('one');
    }
    if(this.value > 10) {
      show = translations.getAttribute('two');
    }
    if(this.value > 25) {
      show = translations.getAttribute('three');
    }
    if(this.value > 40) {
      show = translations.getAttribute('four');
    }
      value.innerHTML = show;
  }); 
});

var checkboxesURL = document.querySelectorAll('.standard-checkbox');
var standardValue = document.querySelector('.filter-end-value-s');

checkboxesURL.forEach((check) => {
  var att = check.getAttribute('name');
  if (att == 'hotel') {
    if (urlParams.get('hotel') != null) {
      check.checked = true;
      standardValue.innerHTML = standardValue.getAttribute('chosen');
    }
  }
  else if (att == 'san') {
    if (urlParams.get('san') != null) {
      check.checked = true;
      standardValue.innerHTML = standardValue.getAttribute('chosen');
    }
  }
  else if (att == 'room') {
    if (urlParams.get('room') != null) {
      check.checked = true;
      standardValue.innerHTML = standardValue.getAttribute('chosen');
    }
  }
});