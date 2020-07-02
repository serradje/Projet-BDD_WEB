$(function(){
			$('.like').on('click', function(){
				var $this = $(this);
				var id = $this.data('id');

				doAction($this, id, 'like');
				return false;	
				
			});


			$('.unlike').on('click', function(){
				var $this = $(this);
				var id = $this.data('id');

				doAction($this, id, 'unlike');
				return false;	
				
			});


			function doAction(obj, id, type){

				$.get('like.php', {'id': id, 'type': type}, function(res){
					
					if (res != 'voted') {
						var like = obj.parent().find('.like-count');
						var count = like.text();
						like.fadeOut().text(res).fadeIn();
						obj.parent().find('.hidden').removeClass('hidden');
						obj.addClass('hidden');

					}else{
						alert("You already voted this product");
					}

					
				});
			}
		});