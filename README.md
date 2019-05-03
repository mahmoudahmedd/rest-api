# REST-API
Photo social media database with REST API

Database Schema Description:
---
<b>user:</b>
<ul>
  <li>
  <p>u_id - (int), Primary ID that preferably auto increments.</p>
  </li>
  <li>
  <p>username - (varchar(32)),  Username (Unique Index, Not null).</p>
  </li>
  <li>
  <p>email - (varchar(32)),  Username (Unique Index, Not null).</p>
  </li>
  <li>
  <p>full_name - (varchar(32)),  Full name of user.</p>
  </li>
  <li>
  <p>password - (varchar(256)), Password of user.</p>
  </li>
  <li>
  <p>profile_pic_path - (varchar(128)), Profile picture (Default 'picture.jpg').</p>
  </li>
  <li>
  <p>access_token - (varchar(256)), Access token for user (Unique Index, Not null).</p>
  </li>
  <li>
  <p>register_date - (DateTime), When did this user sign up?.</p>
  </li>
</ul>

<b>photo:</b>
<ul>
  <li>
  <p>p_id - (int), Primary ID that preferably auto increments.</p>
  </li>
  <li>
  <p>u_id - (int), ID of the user who owns this photo (references users(u_id)).</p>
  </li>
  <li>
  <p>caption - (varchar(1024)),  Photo caption.</p>
  </li>
  <li>
  <p>pic_path - (varchar(128)), Path to image on server (Unique Index, Not null).</p>
  </li>
  <li>
  <p>creation_date - (DateTime), When was this image created?.</p>
  </li>
</ul>

<b>like:</b>
<ul>
  <li>
  <p>l_id - (int), Primary ID that preferably auto increments.</p>
  </li>
  <li>
  <p>u_id - (int), ID of the user performing the like (references users(u_id)).</p>
  </li>
  <li>
  <p>p_id - (int),  ID of the photo being liked (references photos(p_id)).</p>
  </li>
  <li>
  <p>p_id - (DateTime), When was this like created?.</p>
  </li>
</ul>

Description Of Usual Server Responses:
---
<ul>
  <li>
  <p>200 <code>OK</code> - The request was successful.</p>
  </li>
  <li>
  <p>400 <code>Bad Request</code> - The request could not be understood or was missing required parameters.</p>
  </li>
  <li>
  <p>404 <code>Not Found</code> - Resource was not found.</p>
  </li>
  <li>
  <p>503 <code>Service unavailable</code> -  The server is currently unable to handle the request.</p>
  </li>
</ul>


Examples Of Requests:
---
<code>localhost/?a=OBJECT&b=ACTION&access_token=ACCSESS_TOKEN</code><br/><br/>
For profile information of a user: 
localhost:8080/?a=user&b=read&access_token=ACCSESS_TOKEN


License
---
[![License](http://img.shields.io/:license-mit-blue.svg?style=flat-square)](http://badges.mit-license.org)

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2019 © <a href="https://github.com/mahmoudahmedd/" target="_blank">MahmoudAhmed</a>.
