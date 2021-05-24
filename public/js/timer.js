Vue.component( 'timer', {
	props: ['date'],
	data: function () {
		return {
			time: this.date + 3600,
		}
	},
	methods: {
		timer: function(seconds) {
            if (this.time > 0) {
			    seconds = Number(seconds);
			    var d = Math.floor(seconds / (3600*24));
			    var h = this.pad(Math.floor(seconds % (3600*24) / 3600));
			    var m = this.pad(Math.floor(seconds % 3600 / 60));
			    var s = this.pad(Math.floor(seconds % 60));
			    var day = d > 0 ? d + (d == 1 ? " день " : " дня ") : "";
			    return day + h+':'+m+':'+s;
            }else {
                return 'Закрыто';
            }
		},
		pad: function(num) {
    		return (num < 10) ? '0' + num.toString() : num.toString();
		}
	},
  	mounted: function(){
    	setInterval(() => {
      		this.time = this.time - 1;
    	}, 1000);
  	},
	template: `
        <span>
            <span class="timer-visible">{{ timer(time) }}</span>
        </span>
`
});
