ellipsis = {
  'value' : ['', '.', '..', '...', '....', '.....', '......'],
	'count' : 0,
	'run' : false,
	'timer' : null,
	'element' : '.ellipsis',
	'start' : function () {
	  var t = this;
		this.run = true;
		this.timer = setInterval(function () {
			if (t.run) {
				$(t.element).html(t.value[t.count % t.value.length]).text();
				t.count++;
			}
		}, 250);
	},
	'stop' : function () {						
		this.run = false;
		clearInterval(this.timer);
		this.count = 0;
	}
}
ellipsis.start();