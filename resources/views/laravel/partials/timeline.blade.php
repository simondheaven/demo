<div class="dashboard-timeline-container">
  <div class="card" style="border-radius: 0px 25px 0px 25px; background:transparent; border-width: 0px; box-shadow: 0px 0px 15px;">

    <div onclick="timelineShowHide()" class="card-header bg-dark" style="border-radius: 0px 25px 0px 0px; color: #fff;">
      Timeline
    </div>

    <div class="card-body" id="timeline_body">

      <div id="timeline-inner" class="timeline-inner" style="">

      </div>

      <div id="chunk-loader" style="text-align:center; width:100%; display:none;" class="chunk-loader">
        <img src="/img/loading.gif"></img>
      </div>

    </div>

  </div>
</div>

<script>
  var loadedPosts = 0;
  var locked = false;

  function getTimelineChunk(){
    //ensures multiple requests for the same post are not returned
    if(locked){
      return;
    }
    locked = true;

    //display loading gif
    document.getElementById('chunk-loader').style.display = "block";

    //get next chunk of posts
    var timeLineForm = new FormData();
    timeLineForm.append('_token', '{{csrf_token()}}');
    timeLineForm.append('loadedPosts', loadedPosts);
    var timeLineRequest = new XMLHttpRequest();
    timeLineRequest.open("POST", "{{route('timeline.update')}}");
    timeLineRequest.onreadystatechange = function () {
      if(timeLineRequest.readyState === 4 && timeLineRequest.status === 200) {
          //hide loading gif
          document.getElementById('chunk-loader').style.display = "none";
          //add posts to timeline
          addPostsToTimeline(JSON.parse(this.responseText));
          //release lock
          locked = false;
      }
    };
    timeLineRequest.send(timeLineForm);
  }

  function instantiateProfilePic(data){
    var profilePic = "";
    if(!data.user.profile_pic){
      //if user does not have a profile pic, use default
      profilePic = "{{config('app.url')}}/img/user.svg";
    } else {
      profilePic = "{{config('app.url')}}/images/" + data.user.profile_pic.filename;
    }
    return profilePic;
  }

  function insertDootPanel(data){
    var doots = "";
    doots += "<div class='votes-container' id='votes_container_" + data.id + "'>";
    doots += "<span id='updoot_"+data.id+"' onclick='dootPost("+data.id+",1)' class='updoot ";
    var dootCount = 0;
    var downDooted = false;
    for(var j=0; j<data.votes.length; j++){
      dootCount += data.votes[j].value;
      if(data.votes[j].user_id == {{\Auth::user()->id}}){
        if(data.votes[j].value == 1){
          doots += "updoot-active"
        } else {
          downDooted = true;
        }
      }
    }
    doots += "'>"
    doots += '<svg class="bi bi-chevron-up" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
    doots += '<path fill-rule="evenodd" d="M9.646 6.646a.5.5 0 01.708 0l6 6a.5.5 0 01-.708.708L10 7.707l-5.646 5.647a.5.5 0 01-.708-.708l6-6z" clip-rule="evenodd"></path></svg>';
    doots += '</span>';
    doots += "<span class='dootcount' id='dootcount_"+data.id+"'>"+dootCount+"</span>"
    doots += "<span onclick='dootPost("+data.id+",-1)' class='downdoot ";
    if(downDooted){
      doots += "downdoot-active";
    }
    doots += "' id='downdoot_"+data.id+"'>";
    doots += '<svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
    doots += '<path fill-rule="evenodd" d="M3.646 6.646a.5.5 0 01.708 0L10 12.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path></svg>';
    doots += "</span>";
    doots += "</div>"
    doots += "</div>";
    return doots;
  }

  function buildPost(data, profilePic, date,i){
    var post = "";

    //post header
    post += "<div id='post-";
    post += data.id;
    post += "' class='timeline-post ";
    if(i%2==0){
      post += "post-even";
    } else {
      post += "post-odd";
    }
    post += "'>"

    //post body
    post += "<div style='width:100%; padding: 15px; display: grid; grid-template-columns: 1fr 9fr; grid-gap: 5px;'>"
    //insert profile pic
    post += "<div class='post-user-image'>";
    post += "<a href='/laravel/profile/"+data.user_id+"'><img style='width:100%; border-radius:100%;' src='";
    post += profilePic;
    post += "'></img></a>";
    post += insertDootPanel(data);
    post += "<div style='display:grid; grid-template-columns: 6fr 3fr;'>"
    //insert posted by user
    post += "<div><small>Posted by <a style='color:black;' href='/laravel/profile/"+data.user_id+"'><strong>";
    post += data.user.name;
    post += "</strong></small></a></div>"
    //insert posted at date
    post += "<div style='text-align:right;'><small>";
    post += date.toLocaleString();
    post += "</small></div>";
    post += "<hr><hr>";
    post += "<div style=' display:grid; grid-template-columns: 1fr; '>";

    //post content
    post += "<div>";
    if(data.post_type == "TEXT"){
      //post is text only, add text
      post += "<p style='font-family:inherit;'>";
      post += data.text_content;
      post += "</p>";
    } else if(data.post_type == "IMAGE"){
      //post is image, add each image, add text
      for(var j=0; j<data.images.length; j++){
        post += "<img style='max-width: 100%;' src='";
        post += "{{config('app.url')}}/images/"+data.images[j].filename;
        post += "'></img>";
        post += '<hr>';
      }
      post += "<p style='font-family:inherit;'>";
      post += data.text_content;
      post += "</p>";
    } else if(data.post_type == "LINK"){
      //post is a linked url, add containers
      post += "<div class='linked_url_container'>";
      post += "<div id='linked_url_title_"+data.id+"' class='linked_url_title'></div>";
      post += "<hr>";
      post += "<div id='linked_url_image_container_"+data.id+"' class='linked_url_image_container'></div>";
      post += "<hr>"
      post += "<div id='linked_url_description_"+data.id+"' class='linked_url_description'></div>";
      post += "</div>";
      post += "<hr>";
      post += "<p style='font-family:inherit;'>";
      post += data.text_content;
      post += "</p>";
      if(!data.link_title){
        //link preview information has not yet been retrieved, retrieve link info by AJAX
        retrieveLinkInfo(data.id, data.link_url);
      } else {
        //link info exists, delay population until elements are created
        delayLinkBuilding(data.id, data.link_title, data.link_image, data.link_description, data.link_url);
      }
    } else if (data.post_type == "VIDEO"){
      if(data.video){
        if(data.video.converted == 1){
          post += buildVideo(data);
        } else {
          post += "<div id='video_inner_"+data.id+"'>";
          post += "<p>Video is being converted</p>";
          post += "<div style='height:15px; width:100%; border:1px solid black;'>";
          post += "<div style='-webkit-transition: all 10s ease-in; -moz-transition: all 10s ease-in; -ms-transition: all 10s ease-in; -o-transition: all 10s ease-in; transition: all 10s ease-in;text-align:center; width:0%; height:100%; background: limegreen;' id='video_conversion_progress_"+data.id+"'></div>"
          post += "</div>"
          post += "<div style='text-align:center; width:100%;'><img src='/img/loading.gif'></img></div>";
          post += "</div>"
          fetchVideoUpdates(data.id);
        }
      }
    }
    post += "</div>";
    post += "</div>"
    post += "</div>";
    post += "</div>"
    post += "</div>";
    post += addCommentsSection(data);
    post += "</br>";
    return post;
  }

  function buildVideo(data){
    var post = "";
    post+='<figure id="videoContainer">';
    post+= '<video style="max-height:30vh; width:auto;" id="video" width="600" height="400" controls preload="metadata" >';
    post+= '<source src="'+data.video.path_mp4.replace("{{addslashes(public_path())}}","")+'" type="video/mp4">';
    post+= '<source src="'+data.video.path_webm.replace("{{addslashes(public_path())}}","")+'" type="video/webm">';
    post+= '<source src="'+data.video.path_ogg.replace("{{addslashes(public_path())}}","")+'" type="video/ogg">';
    post+= '<object type="application/x-shockwave-flash" data="flash-player.swf?videoUrl='+data.video.path_mp4.replace("{{addslashes(public_path())}}","")+'" width="1024" height="576">';
    post+= '<param name="movie" value="flash-player.swf?videoUrl='+data.video.path_mp4.replace("{{addslashes(public_path())}}","")+'" />';
    post+= '<param name="allowfullscreen" value="true" />';
    post+= '<param name="wmode" value="transparent" />';
    post+= '<param name="flashvars" value="controlbar=over&amp;image=/img/laravel.svg&amp;file=flash-player.swf?videoUrl='+data.video.path_mp4.replace("{{addslashes(public_path())}}","")+'" />';
    post+= /*'<img alt="Image" src="/img/laravel.svg" width="1024" height="428" title="No video playback possible, please download the video from the link below" />'+*/'</object>';
    post+= '<a href="'+data.video.path_mp4.replace("{{addslashes(public_path())}}","")+'">Download MP4</a></video>';
    post+= '<figcaption>&nbsp;</a></figcaption></figure>';
    post += "<hr>";
    post += "<p style='font-family:inherit;'>";
    post += data.text_content;
    post += "</p>";
    return post;
  }

   async function fetchVideoUpdates(post_id){
    setTimeout(function(){
      var getVideoUpdateForm = new FormData();
      getVideoUpdateForm.append('_token', '{{csrf_token()}}');
      getVideoUpdateForm.append('post_id', post_id);
      var getVideoUpdateRequest = new XMLHttpRequest();
      getVideoUpdateRequest.open("POST", "{{route('video.convert.progress')}}");
      getVideoUpdateRequest.onreadystatechange = function () {
        if(getVideoUpdateRequest.readyState === 4 && getVideoUpdateRequest.status === 200) {
            var data = JSON.parse(this.responseText);
            if(data.success){
              if(data.converted == 1){
                console.log(data.post);
                var inner = document.getElementById('video_inner_'+post_id).innerHTML = buildVideo(data.post);
              } else {
                var bar = document.getElementById('video_conversion_progress_'+post_id);
                bar.style.width = data.conversion_progress + "%";
                fetchVideoUpdates(post_id);
              }
            } else {
              fetchVideoUpdates(post_id);
            }
        }
      };
      getVideoUpdateRequest.send(getVideoUpdateForm);
    },3500);
  }

  function addCommentsSection(data){
    var cs = "";
    cs+= "<div class='show_hide_comment_container' id='show_hide_comment_container_"+data.id+"' style='width:100%; background:#343a40; text-align:right; border-radius: 0px 0px 0px 25px;'>";
    cs+= "<button onclick='showComments("+data.id+","+data.comments.length+")' id='show_hide_comment_"+data.id+"' style='border-radius:25px 0px 0px 0px;' class='btn btn-outline-success'>Show Comments &nbsp;&nbsp;&nbsp;<span id='comment_count_badge_"+data.id+"' class='badge badge-success'><small>"+data.comments.length+"</small></span></button>"
    cs+= "</div>";
    cs+= "<div class='comments_panel_container' id='comments_panel_container_"+data.id+"' style='width:100%;'>";
    cs+= "<div id='main_comments_container_"+data.id+"' style='overflow-y:auto; padding: 15px; width:80%; background:#393f45; max-height: 250px; margin-left: 10%; margin-right: 10%; color: #fff'>"
    cs+= buildComments(data);
    cs+= "</div>";
    cs+= "<div style='height: 90px; box-shadow: 10px -10px 10px rgb(0,0,0,0.5); width:100%; color: #fff; border-radius:  25px; display: grid; grid-template-columns: 5fr 1fr' class='card-footer bg-dark'>";

    cs+= "<textarea id='add_comment_text_"+data.id+"' style='border-radius:25px 0px 0px 25px; padding:15px;'></textarea>";
    cs+= "<button onclick='addNewComment("+data.id+")' style='border-radius: 0px 25px 25px 0px;' class='btn btn-outline-success'>Add Comment</button>"
    cs+= "</div>";
    cs+= "</div>";
    return cs;
  }

  function addNewComment(post_id){
    var content = document.getElementById('add_comment_text_'+post_id).value;
    if(locked || !content || content.trim() == ""){
      return;
    }
    locked = true;
    //send upvote ajax request
    var commentForm = new FormData();
    commentForm.append('_token', '{{csrf_token()}}');
    commentForm.append('post_id', post_id);
    commentForm.append('content', content);
    var commentRequest = new XMLHttpRequest();
    commentRequest.open("POST", "{{route('post.comment')}}");
    commentRequest.onreadystatechange = function () {
      if(commentRequest.readyState === 4 && commentRequest.status === 200) {
          var data = JSON.parse(this.responseText);
          document.getElementById('main_comments_container_'+data.id).innerHTML = buildComments(data);
          document.getElementById('add_comment_text_'+post_id).value = "";
          document.getElementById('comment_count_badge_'+post_id).innerHTML = data.comments.length;
          //release lock
          locked = false;
      }
    };
    commentRequest.send(commentForm);
  }

  function buildComments(data){
    var comms = "";
    for(var i=0; i<data.comments.length; i++){
      comms+= "<div style='width:100%; display:grid; grid-gap: 15px; grid-template-columns: 1fr 5fr; background: #fff; border-radius: 25px; color: #000;'>";
      comms+= "<img style='width:100%; max-width: 75px; border-radius:100%;' src='"+instantiateProfilePic(data.comments[i])+"'></img>";
      comms+= "<div>"
      comms+= "<p><small>"+data.comments[i].user.name+" - "+new Date(data.comments[i].created_at).toLocaleString()+"</small></p>"
      comms+= "<hr>";
      comms+= "<p>"+data.comments[i].content+"</p>";
      comms+= "</div>";
      comms+= "</div>";
      comms+= "</br>";
    }
    return comms;
  }

  function showComments(id, commentCount){
    var elem1 = document.getElementById('comments_panel_container_'+id);
    var elem2 = document.getElementById('show_hide_comment_'+id);
    var elem3 = document.getElementById('show_hide_comment_container_'+id);

    if(elem1.classList.contains('comments_panel_container')){
      elem1.classList.remove('comments_panel_container');
      elem1.classList.add('comments_panel_container_active');
      elem2.innerHTML = elem2.innerHTML.replace("Show","Hide");
      elem2.classList.remove('btn-outline-success');
      elem2.classList.add('btn-success');
      elem3.classList.remove('show_hide_comment_container');
      elem3.classList.add('show_hide_comment_container_active');
    } else {
      elem1.classList.remove('comments_panel_container_active');
      elem1.classList.add('comments_panel_container');
      elem2.innerHTML = elem2.innerHTML.replace("Hide","Show");
      elem2.classList.remove('btn-success');
      elem2.classList.add('btn-outline-success');
      elem3.classList.remove('show_hide_comment_container_active');
      elem3.classList.add('show_hide_comment_container');
    }
  }

  function addPostsToTimeline(data){
    //update chunk skip value
    loadedPosts += data.length;
    //get output div
    var timeline = document.getElementById('timeline-inner');
    //instantiate new data string
    var newPosts = "";

    for(var i=0; i<data.length; i++){

      var profilePic = instantiateProfilePic(data[i]);
      var date = new Date(data[i].created_at);

      newPosts += buildPost(data[i],profilePic,date,i)
    }
    //add new html to timeline wrapper
    timeline.innerHTML = timeline.innerHTML + newPosts;
  }

  function dootPost(post_id, doot_value){
    //ensure multiple votes can not be added
    if(locked){
      return;
    }
    locked = true;
    //send upvote ajax request
    var dootForm = new FormData();
    dootForm.append('_token', '{{csrf_token()}}');
    dootForm.append('post_id', post_id);
    dootForm.append('doot_value', doot_value);
    var dootRequest = new XMLHttpRequest();
    dootRequest.open("POST", "{{route('post.doot')}}");
    dootRequest.onreadystatechange = function () {
      if(dootRequest.readyState === 4 && dootRequest.status === 200) {
          var data = JSON.parse(this.responseText);
          //update vote count for post
          document.getElementById('dootcount_'+data.post_id).innerHTML = data.post_total;
          //remove user's up/down vote active icon status
          document.getElementById('updoot_'+data.post_id).classList.remove("updoot-active");
          document.getElementById('downdoot_'+data.post_id).classList.remove("downdoot-active");
          //add user's new relevant up/down vote active icon status
          if(data.doot_value == 1){
            document.getElementById('updoot_'+data.post_id).classList.add("updoot-active");
          } else if (data.doot_value == -1){
            document.getElementById('downdoot_'+data.post_id).classList.add("downdoot-active");
          }
          //release lock
          locked = false;
      }
    };
    dootRequest.send(dootForm);
  }

  function retrieveLinkInfo(post_id, url){
    //retrieve link preview data
    var urlReq = new XMLHttpRequest();
    urlReq.open("GET", "https://api.linkpreview.net?key=5e2ad7ef946392fdc51313d62668207cd6a89fa8500f7&q="+url);
    urlReq.onreadystatechange = function () {
      if(urlReq.readyState === 4 && urlReq.status === 200) {
          var linkdata = JSON.parse(this.responseText);
          //post to controller
          updateLinkInfo(post_id,linkdata);
      } else if(urlReq.status == 423){
        var data = {
          title : "Title Could Not Be Retrieved",
          description : "The request was denied by the remote server. Url: "+url,
          image : "{{config('app.url')}}/img/laravel.svg"
        }
        updateLinkInfo(post_id,data);
      }
    };
    urlReq.send();
  }

  function updateLinkInfo(post_id, data){
    //post updated link preview information to the controller to be added to the database
    var updateLinkForm = new FormData();
    updateLinkForm.append('_token', '{{csrf_token()}}');
    updateLinkForm.append('post_id', post_id);
    updateLinkForm.append('link_title', data.title);
    updateLinkForm.append('link_description', data.description);
    updateLinkForm.append('link_image', data.image);
    var updateLinkRequest = new XMLHttpRequest();
    updateLinkRequest.open("POST", "{{route('update.link')}}");
    updateLinkRequest.onreadystatechange = function () {
      if(updateLinkRequest.readyState === 4 && updateLinkRequest.status === 200) {
          //returns full updated post info
          var data = JSON.parse(this.responseText);
          //build link preview
          buildLinkPreview(data.id, data.link_title, data.link_image, data.link_description, data.link_url);
      }
    };
    updateLinkRequest.send(updateLinkForm);
  }

  function delayLinkBuilding(id,title,image,descrption,url){
    setTimeout(function(){
       buildLinkPreview(id,title,image,descrption,url);
     }, 1500);
  }

  function buildLinkPreview(id, title, image, description, url){
    //add link preview info into pre-built containers
    document.getElementById('linked_url_title_'+id).innerHTML = "<a class='linked_link' href='"+url+"'><h3>"+title+"</h3></a>";
    document.getElementById('linked_url_image_container_'+id).innerHTML = "<a class='linked_link' href='"+url+"'><img class='linked_url_image' src='"+image+"'></img></a>";
    document.getElementById('linked_url_description_'+id).innerHTML = "<a class='linked_link' href='"+url+"'><p>"+description+"</p></a>";
  }

  var timelineShow = true;

  function timelineShowHide(){
    if(timelineShow){
      document.getElementById('timeline_body').style.display = "none";
    } else {
      document.getElementById('timeline_body').style.display = "block";
    }
    timelineShow = !timelineShow;
  }

  //fetch first timeline chunk on page load
  getTimelineChunk();

</script>
