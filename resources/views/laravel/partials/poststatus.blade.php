<div class="post-status-container">

  <div class="card" style="border-radius: 0px 25px 0px 25px; background:transparent; border-width: 0px; box-shadow: 0px 0px 15px;">

    <div onclick="showHidePostUpdate()" class="card-header bg-dark" style="border-radius: 0px 25px 0px 0px; color: #fff;">
      Post an update
    </div>

    <div class="card-body" id="post_update_body">

      <form id="post-status-form" action="{{ route('post.status') }}" method="POST">

        <input type="hidden" name="post_type" value="TEXT"></input>
        <input type="hidden" name="_token" value="{{csrf_token()}}"></input>

        <textarea name="text_content" placeholder="Post a status..." autofocus required style="resize:none; width: 100%; height: 145px; border-bottom:0px;" class="post-status-textarea"></textarea>

        <div style="display:grid; grid-template-columns: repeat(4,1fr); margin-top:-5px;" class="post-status-toolbox">
          <div style="text-align:center;" class="post-staus-tool">
            <button type="button" style="width:100%; height:40px; padding:2px;" title="Post a status" class="btn btn-dark">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-justify" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4 14.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" onclick="switchStatusType('IMAGE')" style="width:100%; height:40px; padding:2px;" title="Post an image" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-images" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.002 6h-10a1 1 0 00-1 1v8a1 1 0 001 1h10a1 1 0 001-1V7a1 1 0 00-1-1zm-10-1a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-10z" clip-rule="evenodd"></path>
                  <path d="M12.648 10.646a.5.5 0 01.577-.093l1.777 1.947V16h-12v-1l2.646-2.354a.5.5 0 01.63-.062l2.66 1.773 3.71-3.71z"></path>
                  <path fill-rule="evenodd" d="M6.502 11a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM6 4h10a1 1 0 011 1v8a1 1 0 01-1 1v1a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2h1a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" onclick="switchStatusType('VIDEO')" style="width:100%; height:40px; padding:2px;" title="Post a video" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-camera-video" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4.667 5.5c-.645 0-1.167.522-1.167 1.167v6.666c0 .645.522 1.167 1.167 1.167h6.666c.645 0 1.167-.522 1.167-1.167V6.667c0-.645-.522-1.167-1.167-1.167H4.667zM2.5 6.667C2.5 5.47 3.47 4.5 4.667 4.5h6.666c1.197 0 2.167.97 2.167 2.167v6.666c0 1.197-.97 2.167-2.167 2.167H4.667A2.167 2.167 0 012.5 13.333V6.667z" clip-rule="evenodd"></path>
                  <path fill-rule="evenodd" d="M13.25 7.65l2.768-1.605a.318.318 0 01.482.263v7.384c0 .228-.26.393-.482.264l-2.767-1.605-.502.865 2.767 1.605c.859.498 1.984-.095 1.984-1.129V6.308c0-1.033-1.125-1.626-1.984-1.128L12.75 6.785l.502.865z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" onclick="switchStatusType('LINK')" style="width:100%; height:40px; padding:2px;" title="Post a link" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-tag" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 014 2.5h4.586a1.5 1.5 0 011.06.44l7 7a1.5 1.5 0 010 2.12l-4.585 4.586a1.5 1.5 0 01-2.122 0l-7-7a1.5 1.5 0 01-.439-1.06V4zM4 3.5a.5.5 0 00-.5.5v4.586a.5.5 0 00.146.353l7 7a.5.5 0 00.708 0l4.585-4.585a.5.5 0 000-.708l-7-7a.5.5 0 00-.353-.146H4z" clip-rule="evenodd"></path>
                  <path fill-rule="evenodd" d="M4.5 6.5a2 2 0 114 0 2 2 0 01-4 0zm2-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
        </div>

        <button style="width:100%;" class="btn btn-outline-success">Submit</button>

      </form>

      <div id="post-image-form" style="display:none;">

        <form style="height: 15vh; box-sizing:border-box; overflow:auto; border-bottom:0px; width:50%;" method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
          {{csrf_field()}}
        </form>

        <form style="margin-top:-150px;" action="{{ route('post.status') }}" method="POST">

        <div style="display:grid; width: 100%; grid-template-columns: 1fr 1fr;">
          <div style="width:100%; height:145px; z-index: -1000;">&nbsp;</div>
          <textarea name="text_content" placeholder="Post a description..." autofocus required style="resize:none; width: 100%; height: 145px; border-bottom:0px;" class="post-status-textarea"></textarea>
        </div>

        <input type="hidden" name="fileIDs" id="imageFileIDs" value=""></input>
        <input type="hidden" name="post_type" value="IMAGE"></input>
        <input type="hidden" name="_token" value="{{csrf_token()}}"></input>

        <div style="display:grid; grid-template-columns: repeat(4,1fr); margin-top:-5px;" class="post-status-toolbox">
          <div style="text-align:center;" class="post-staus-tool">
            <button type="button" onclick="switchStatusType('TEXT')"  style="width:100%; height:40px; padding:2px;" title="Post a status" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-justify" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4 14.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button"   style="width:100%; height:40px; padding:2px;" title="Post an image" class="btn btn-dark">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-images" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.002 6h-10a1 1 0 00-1 1v8a1 1 0 001 1h10a1 1 0 001-1V7a1 1 0 00-1-1zm-10-1a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-10z" clip-rule="evenodd"></path>
                  <path d="M12.648 10.646a.5.5 0 01.577-.093l1.777 1.947V16h-12v-1l2.646-2.354a.5.5 0 01.63-.062l2.66 1.773 3.71-3.71z"></path>
                  <path fill-rule="evenodd" d="M6.502 11a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM6 4h10a1 1 0 011 1v8a1 1 0 01-1 1v1a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2h1a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" onclick="switchStatusType('VIDEO')"  style="width:100%; height:40px; padding:2px;" title="Post a video" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-camera-video" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4.667 5.5c-.645 0-1.167.522-1.167 1.167v6.666c0 .645.522 1.167 1.167 1.167h6.666c.645 0 1.167-.522 1.167-1.167V6.667c0-.645-.522-1.167-1.167-1.167H4.667zM2.5 6.667C2.5 5.47 3.47 4.5 4.667 4.5h6.666c1.197 0 2.167.97 2.167 2.167v6.666c0 1.197-.97 2.167-2.167 2.167H4.667A2.167 2.167 0 012.5 13.333V6.667z" clip-rule="evenodd"></path>
                  <path fill-rule="evenodd" d="M13.25 7.65l2.768-1.605a.318.318 0 01.482.263v7.384c0 .228-.26.393-.482.264l-2.767-1.605-.502.865 2.767 1.605c.859.498 1.984-.095 1.984-1.129V6.308c0-1.033-1.125-1.626-1.984-1.128L12.75 6.785l.502.865z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" onclick="switchStatusType('LINK')"  style="width:100%; height:40px; padding:2px;" title="Post a link" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-tag" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 014 2.5h4.586a1.5 1.5 0 011.06.44l7 7a1.5 1.5 0 010 2.12l-4.585 4.586a1.5 1.5 0 01-2.122 0l-7-7a1.5 1.5 0 01-.439-1.06V4zM4 3.5a.5.5 0 00-.5.5v4.586a.5.5 0 00.146.353l7 7a.5.5 0 00.708 0l4.585-4.585a.5.5 0 000-.708l-7-7a.5.5 0 00-.353-.146H4z" clip-rule="evenodd"></path>
                  <path fill-rule="evenodd" d="M4.5 6.5a2 2 0 114 0 2 2 0 01-4 0zm2-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
        </div>

        <button style="width:100%;" class="btn btn-outline-success">Submit</button>

        </form>
      </div>

      <form id="post-link-form" style="display:none;" action="{{ route('post.status') }}" method="POST">

        <input type="hidden" name="post_type" value="LINK"></input>
        <input type="hidden" name="_token" value="{{csrf_token()}}"></input>

        <div style="display:grid; grid-template-columns: 1fr 6fr; grid-gap: 15px;">
          <label for="link_url">Url:</label>
          <input id="link_url" class="form-control" name="link_url" required autocomplete="off" type="url"></input>
          <label for="text_content">Comment:</label>
          <textarea name="text_content" placeholder="Post a comment..." autofocus required style="resize:none; width: 100%; height: 97px; border-bottom:0px;" class="post-status-textarea"></textarea>
        </div>

        <div style="display:grid; grid-template-columns: repeat(4,1fr); margin-top:-5px;" class="post-status-toolbox">
          <div style="text-align:center;" class="post-staus-tool">
            <button onclick="switchStatusType('TEXT')"  type="button" style="width:100%; height:40px; padding:2px;" title="Post a status" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-justify" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4 14.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" onclick="switchStatusType('IMAGE')" style="width:100%; height:40px; padding:2px;" title="Post an image" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-images" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.002 6h-10a1 1 0 00-1 1v8a1 1 0 001 1h10a1 1 0 001-1V7a1 1 0 00-1-1zm-10-1a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-10z" clip-rule="evenodd"></path>
                  <path d="M12.648 10.646a.5.5 0 01.577-.093l1.777 1.947V16h-12v-1l2.646-2.354a.5.5 0 01.63-.062l2.66 1.773 3.71-3.71z"></path>
                  <path fill-rule="evenodd" d="M6.502 11a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM6 4h10a1 1 0 011 1v8a1 1 0 01-1 1v1a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2h1a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" onclick="switchStatusType('VIDEO')" style="width:100%; height:40px; padding:2px;" title="Post a video" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-camera-video" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4.667 5.5c-.645 0-1.167.522-1.167 1.167v6.666c0 .645.522 1.167 1.167 1.167h6.666c.645 0 1.167-.522 1.167-1.167V6.667c0-.645-.522-1.167-1.167-1.167H4.667zM2.5 6.667C2.5 5.47 3.47 4.5 4.667 4.5h6.666c1.197 0 2.167.97 2.167 2.167v6.666c0 1.197-.97 2.167-2.167 2.167H4.667A2.167 2.167 0 012.5 13.333V6.667z" clip-rule="evenodd"></path>
                  <path fill-rule="evenodd" d="M13.25 7.65l2.768-1.605a.318.318 0 01.482.263v7.384c0 .228-.26.393-.482.264l-2.767-1.605-.502.865 2.767 1.605c.859.498 1.984-.095 1.984-1.129V6.308c0-1.033-1.125-1.626-1.984-1.128L12.75 6.785l.502.865z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" style="width:100%; height:40px; padding:2px;" title="Post a link" class="btn btn-dark">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-tag" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 014 2.5h4.586a1.5 1.5 0 011.06.44l7 7a1.5 1.5 0 010 2.12l-4.585 4.586a1.5 1.5 0 01-2.122 0l-7-7a1.5 1.5 0 01-.439-1.06V4zM4 3.5a.5.5 0 00-.5.5v4.586a.5.5 0 00.146.353l7 7a.5.5 0 00.708 0l4.585-4.585a.5.5 0 000-.708l-7-7a.5.5 0 00-.353-.146H4z" clip-rule="evenodd"></path>
                  <path fill-rule="evenodd" d="M4.5 6.5a2 2 0 114 0 2 2 0 01-4 0zm2-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
        </div>

        <button style="width:100%;" class="btn btn-outline-success">Submit</button>
      </form>



      <form id="post-video-form" style="display:none;" action="{{ route('post.status') }}" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="post_type" value="VIDEO"></input>
        <input type="hidden" name="_token" value="{{csrf_token()}}"></input>

        <div style="display:grid; grid-template-columns: 1fr 6fr; grid-gap: 15px;">
          <label for="link_url">Video:</label>
          <input id="videoFile" class="form-control" name="file" accept="video/mp4,video/x-m4v,video/*" required type="file"></input>
          <label for="text_content">Comment:</label>
          <textarea name="text_content" placeholder="Post a comment..." autofocus required style="resize:none; width: 100%; height: 97px; border-bottom:0px;" class="post-status-textarea"></textarea>
        </div>

        <div style="display:grid; grid-template-columns: repeat(4,1fr); margin-top:-5px;" class="post-status-toolbox">
          <div style="text-align:center;" class="post-staus-tool">
            <button onclick="switchStatusType('TEXT')"  type="button" style="width:100%; height:40px; padding:2px;" title="Post a status" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-justify" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4 14.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" onclick="switchStatusType('IMAGE')" style="width:100%; height:40px; padding:2px;" title="Post an image" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-images" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.002 6h-10a1 1 0 00-1 1v8a1 1 0 001 1h10a1 1 0 001-1V7a1 1 0 00-1-1zm-10-1a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-10z" clip-rule="evenodd"></path>
                  <path d="M12.648 10.646a.5.5 0 01.577-.093l1.777 1.947V16h-12v-1l2.646-2.354a.5.5 0 01.63-.062l2.66 1.773 3.71-3.71z"></path>
                  <path fill-rule="evenodd" d="M6.502 11a1.5 1.5 0 100-3 1.5 1.5 0 000 3zM6 4h10a1 1 0 011 1v8a1 1 0 01-1 1v1a2 2 0 002-2V5a2 2 0 00-2-2H6a2 2 0 00-2 2h1a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button"  style="width:100%; height:40px; padding:2px;" title="Post a video" class="btn btn-dark">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-camera-video" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4.667 5.5c-.645 0-1.167.522-1.167 1.167v6.666c0 .645.522 1.167 1.167 1.167h6.666c.645 0 1.167-.522 1.167-1.167V6.667c0-.645-.522-1.167-1.167-1.167H4.667zM2.5 6.667C2.5 5.47 3.47 4.5 4.667 4.5h6.666c1.197 0 2.167.97 2.167 2.167v6.666c0 1.197-.97 2.167-2.167 2.167H4.667A2.167 2.167 0 012.5 13.333V6.667z" clip-rule="evenodd"></path>
                  <path fill-rule="evenodd" d="M13.25 7.65l2.768-1.605a.318.318 0 01.482.263v7.384c0 .228-.26.393-.482.264l-2.767-1.605-.502.865 2.767 1.605c.859.498 1.984-.095 1.984-1.129V6.308c0-1.033-1.125-1.626-1.984-1.128L12.75 6.785l.502.865z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
          <div style="text-align:center;" class="post-status-tool">
            <button type="button" onclick="switchStatusType('LINK')" style="width:100%; height:40px; padding:2px;" title="Post a link" class="btn btn-light">
              <h2 style="margin-top:-6px;">
                <svg class="bi bi-tag" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 014 2.5h4.586a1.5 1.5 0 011.06.44l7 7a1.5 1.5 0 010 2.12l-4.585 4.586a1.5 1.5 0 01-2.122 0l-7-7a1.5 1.5 0 01-.439-1.06V4zM4 3.5a.5.5 0 00-.5.5v4.586a.5.5 0 00.146.353l7 7a.5.5 0 00.708 0l4.585-4.585a.5.5 0 000-.708l-7-7a.5.5 0 00-.353-.146H4z" clip-rule="evenodd"></path>
                  <path fill-rule="evenodd" d="M4.5 6.5a2 2 0 114 0 2 2 0 01-4 0zm2-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                </svg>
              </h2>
            </button>
          </div>
        </div>

        <button style="width:100%;" class="btn btn-outline-success">Submit</button>
      </form>

    </div>
  </div>
</div>

@if(Session::has('video'))


  <script>

    async function convertVideo(){
      var convertMP4Form = new FormData();
      convertMP4Form.append('_token', '{{csrf_token()}}');
      convertMP4Form.append('post_id', {{Session::get('video')->post_id}});
      var convertMP4Request = new XMLHttpRequest();
      convertMP4Request.open("POST", "{{route('video.convert.mp4')}}");
      convertMP4Request.onreadystatechange = function () {
        if(convertMP4Request.readyState === 4 && convertMP4Request.status === 200) {
            //console.log(this.responseText);
        }
      };
      convertMP4Request.send(convertMP4Form);
    }
    setTimeout(function(){
      convertVideo();
    },500);

    /*setTimeout(function(){
      var convertOggForm = new FormData();
      convertOggForm.append('_token', '{{csrf_token()}}');
      convertOggForm.append('post_id', {{Session::get('video')->post_id}});
      var convertOggRequest = new XMLHttpRequest();
      convertOggRequest.open("POST", "{{route('video.convert.ogg')}}");
      convertOggRequest.onreadystatechange = function () {
        if(convertOggRequest.readyState === 4 && convertOggRequest.status === 200) {
            console.log(this.responseText);
        }
      };
      convertOggRequest.send(convertOggForm);
    },750);

    setTimeout(function(){
      var convertWebmForm = new FormData();
      convertWebmForm.append('_token', '{{csrf_token()}}');
      convertWebmForm.append('post_id', {{Session::get('video')->post_id}});
      var convertWebmRequest = new XMLHttpRequest();
      convertWebmRequest.open("POST", "{{route('video.convert.webm')}}");
      convertWebmRequest.onreadystatechange = function () {
        if(convertWebmRequest.readyState === 4 && convertWebmRequest.status === 200) {
            console.log(this.responseText);
        }
      };
      convertWebmRequest.send(convertWebmForm);
    },1000);*/

  </script>
@endif


<script>

  var statusTypes = [
    'post-status-form',
    'post-image-form',
    'post-link-form',
    'post-video-form'
  ];

  function switchStatusType(selection){
    for(var i=0; i< statusTypes.length; i++){
      document.getElementById(statusTypes[i]).style.display = "none";
    }
    if(selection == "IMAGE"){
      document.getElementById('post-image-form').style.display = "block";
    } else if (selection == "TEXT"){
      document.getElementById('post-status-form').style.display = "block";
    } else if (selection == "LINK"){
      document.getElementById('post-link-form').style.display = "block";
    } else if (selection == "VIDEO"){
      document.getElementById('post-video-form').style.display = "block";
    }
  }

  var postUpdateShow = true;

  function showHidePostUpdate(){
    if(postUpdateShow){
      document.getElementById('post_update_body').style.display = "none";
    } else {
      document.getElementById('post_update_body').style.display = "block";
    }
    postUpdateShow = !postUpdateShow;
  }

</script>
