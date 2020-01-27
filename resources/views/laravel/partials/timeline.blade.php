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

  function addPostsToTimeline(data){
    //update chunk skip value
    loadedPosts += data.length;
    //get output div
    var timeline = document.getElementById('timeline-inner');
    //instantiate new data string
    var newPosts = "";
    for(var i=0; i<data.length; i++){

      var profilePic;
      var date = new Date(data[i].created_at);
      console.log(data[i]);
      if(data[i].user.profile_pic == null){
        //if user does not have a profile pic, use default
        profilePic = "{{config('app.url')}}/img/user.svg";
      } else {
        profilePic = "{{config('app.url')}}/images/" + data[i].user.profile_pic.filename;
      }

      newPosts += "<div id='post-";
      newPosts += data[i].id;
      newPosts += "' class='timeline-post ";
      //assign odd/even classes for css purposes
      if(i%2==0){
        newPosts += "post-even";
      } else {
        newPosts += "post-odd";
      }
      newPosts += "'>"
      newPosts += "<div style='width:100%; padding: 15px; display: grid; grid-template-columns: 1fr 9fr; grid-gap: 5px;'>"
      //insert profile pic
      newPosts += "<div class='post-user-image'>";
      newPosts += "<a href='/laravel/profile/"+data[i].user_id+"'><img style='width:100%; border-radius:100%;' src='";
      newPosts += profilePic;
      newPosts += "'></img></a>";
      //insert up/downdoot panel
      newPosts += "<div class='votes-container' id='votes_container_" + data[i].id + "'>";
      newPosts += "<span id='updoot_"+data[i].id+"' onclick='dootPost("+data[i].id+",1)' class='updoot ";
      var dootCount = 0;
      var downDooted = false;
      for(var j=0; j<data[i].votes.length; j++){
        dootCount += data[i].votes[j].value;
        if(data[i].votes[j].user_id == {{\Auth::user()->id}}){
          if(data[i].votes[j].value == 1){
            newPosts += "updoot-active"
          } else {
            downDooted = true;
          }
        }
      }
      newPosts += "'>"
      newPosts += '<svg class="bi bi-chevron-up" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
      newPosts += '<path fill-rule="evenodd" d="M9.646 6.646a.5.5 0 01.708 0l6 6a.5.5 0 01-.708.708L10 7.707l-5.646 5.647a.5.5 0 01-.708-.708l6-6z" clip-rule="evenodd"></path></svg>';
      newPosts += '</span>';
      newPosts += "<span class='dootcount' id='dootcount_"+data[i].id+"'>"+dootCount+"</span>"
      newPosts += "<span onclick='dootPost("+data[i].id+",-1)' class='downdoot ";
      if(downDooted){
        newPosts += "downdoot-active";
      }
      newPosts += "' id='downdoot_"+data[i].id+"'>";
      newPosts += '<svg class="bi bi-chevron-down" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">';
      newPosts += '<path fill-rule="evenodd" d="M3.646 6.646a.5.5 0 01.708 0L10 12.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path></svg>';
      newPosts += "</span>";
      newPosts += "</div>"
      newPosts += "</div>";
      newPosts += "<div style='display:grid; grid-template-columns: 6fr 3fr;'>"
      //insert posted by user
      newPosts += "<div><small>Posted by <a style='color:black;' href='/laravel/profile/"+data[i].user_id+"'><strong>";
      newPosts += data[i].user.name;
      newPosts += "</strong></small></a></div>"
      //insert posted at date
      newPosts += "<div style='text-align:right;'><small>";
      newPosts += date.toLocaleString();
      newPosts += "</small></div>";
      newPosts += "<hr><hr>";
      newPosts += "<div style=' display:grid; grid-template-columns: 1fr; '>";
      newPosts += "<div>";
      if(data[i].post_type == "TEXT"){
        //post is text only, add text
        newPosts += "<p style='font-family:inherit;'>";
        newPosts += data[i].text_content;
        newPosts += "</p>";
      } else if(data[i].post_type == "IMAGE"){
        //post is image, add each image, add text
        for(var j=0; j<data[i].images.length; j++){
          newPosts += "<img style='max-width: 100%;' src='";
          newPosts += "{{config('app.url')}}/images/"+data[i].images[j].filename;
          newPosts += "'></img>";
          newPosts += '<hr>';
        }
        newPosts += "<p style='font-family:inherit;'>";
        newPosts += data[i].text_content;
        newPosts += "</p>";
      } else if(data[i].post_type == "LINK"){
        //post is a linked url, add containers
        newPosts += "<div class='linked_url_container'>";
        newPosts += "<div id='linked_url_title_"+data[i].id+"' class='linked_url_title'></div>";
        newPosts += "<hr>";
        newPosts += "<div id='linked_url_image_container_"+data[i].id+"' class='linked_url_image_container'></div>";
        newPosts += "<hr>"
        newPosts += "<div id='linked_url_description_"+data[i].id+"' class='linked_url_description'></div>";
        newPosts += "</div>";
        newPosts += "<hr>";
        newPosts += "<p style='font-family:inherit;'>";
        newPosts += data[i].text_content;
        newPosts += "</p>";
        if(!data[i].link_title){
          //link preview information has not yet been retrieved, retrieve link info by AJAX
          retrieveLinkInfo(data[i].id, data[i].link_url);
        } else {
          //link info exists, delay population until elements are created
          delayLinkBuilding(data[i].id, data[i].link_title, data[i].link_image, data[i].link_description, data[i].link_url);
        }
      }
      newPosts += "</div>";
      newPosts += "</div>"
      newPosts += "</div>";
      newPosts += "</div>"
      newPosts += "</div>";
      newPosts += "</br>";
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
