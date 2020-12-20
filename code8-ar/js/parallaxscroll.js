!function (a) {
	var b = a(window),
		c = b.height();
	b.resize(function () {
		c = b.height()
	}), a.fn.parallax = function (d, e, f) {
		function g() {
			h.each(function () {
				j = h.offset().top
			}), i = f ? function (a) {
				return a.outerHeight(!0)
			} : function (a) {
				return a.height()
			}, (arguments.length < 1 || null === d) && (d = "50%"), (arguments.length < 2 || null === e) && (e = .5), (arguments.length < 3 || null === f) && (f = !0);
			var g = b.scrollTop();
			h.each(function () {
				var b = a(this),
					f = b.offset().top,
					k = i(b);
				g > f + k || f > g + c || h.css("backgroundPosition", d + " " + Math.round((j - g) * e) + "px")
			})
		}
		var i, j, h = a(this);
		b.bind("scroll", g).resize(g), g()
	}
}(jQuery);