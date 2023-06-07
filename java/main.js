var minusBtns = document.querySelectorAll('.minus-btn');
    var plusBtns = document.querySelectorAll('.plus-btn');

    minusBtns.forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        var input = this.nextElementSibling;
        var value = parseInt(input.value);
        if (value > 1) {
          input.value = value - 1;
        }
      });
    });

    plusBtns.forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        var input = this.previousElementSibling;
        var value = parseInt(input.value);
        input.value = value + 1;
      });
    });
