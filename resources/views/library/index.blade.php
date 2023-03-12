@extends('main')
@section('title', 'Library')
@section('content')
<div class="w3-row">
    <div style="margin-left: auto;margin-right:auto; width:90%;">
        <p id='bits' class="{bits}"><br></p>
        <div class="homesearch w3-margin w3-row w3-grey w3-round-xlarge w3-card">
            <img class="w3-col w3-margin" src="{bits}/Resources/Images/search.png" style="width:45px" />
            <h3 class="w3-rest w3-margin-right w3-margin">
                <input class="w3-input w3-round-xlarge w3-border-0 w3-padding" style="padding-left:30px;font-weight:bold" name="librarySearchTF" onkeyup="search.liveSearch('librarySearchTF')" type="text" placeholder="Search for Books, Authors, Students, Genres, Subjects" />
                <ul id="librarySearchResults" class="w3-white w3-ul w3-card" style="position:absolute;width:80%;display:none">
                </ul>
            </h3>
        </div>
        <br>
        <div class="redfont w3-margin-top w3-row">
            <div class="w3-left">
                <img src="Resources/Images/library.png" class="w3-margin w3-col" style="width:15%;">
                <h1>
                    <b>School Library</b>
                </h1>
            </div>
            <a href="systemprivileges" class="w3-right w3-btn w3-round-large blueborder w3-white w3-card w3-large w3-margin">
                <b>System Privileges</b>
            </a>
        </div>
        <div class="redfont"  style="font-weight:bold">
            <div class="w3-third">
                <div class="w3-card w3-row w3-white w3-border-bottom w3-border-red">
                    <img src="Resources/Images/borrow_book.png" class="w3-margin w3-col" style="width:15%;">
                    <div class="w3-container redfont w3-rest">
                        <p><a href="staff">Book Checkin</a></p>
                    </div>
                </div>
            </div>
            <div class="w3-third w3-white ">
                <div class="w3-card w3-row  w3-border-bottom w3-border-red">
                    <img src="Resources/Images/return_book.png" class="w3-margin w3-col" style="width:15%;">
                    <div class="w3-container redfont w3-rest">
                        <p><a href="students">Book Checkout</a></p>
                    </div>
                </div>
            </div>
            <div class="w3-third w3-white">
                <div class="w3-card w3-row w3-border-bottom w3-border-red">
                    <img src="Resources/Images/books.png" class="w3-margin w3-col" style="width:15%;">
                    <div class="w3-container redfont w3-rest">
                        <p><a href="#" onclick='alert();'>BOOKS</a></p>
                    </div>
                </div>
            </div>
        </div>
    <br/>
        <div class='w3-container w3-margin w3-white w3-card'>
            <h3 class="bluefont">
                <img src="Resources/Images/classes.png" style="width:30px;margin: 3px">
                <b>Classes<b>
                    
            </h3>
            <div class='w3-row w3-padding w3-white w3-round-xxlarge w3-margin-bottom w3-text-grey' style='max-height:200px;overflow-y:auto'>
                <!-- START homeclasslist -->
                <div class='w3-left w3-btn w3-padding w3-border w3-card w3-round-xlarge w3-margin'>
                    <a href='classes/view?classid={ID}' class='' style='text-decoration:none;'>
                        <h6 class='w3-border-bottom w3-large'>{abbr}</h6>
                        <div class='w3-tiny'>Num on roll:<span class='w3-text-green'>{numonroll} </span></div>
                    </a>
                </div>
                <!-- END homeclasslist -->
            </div>
        </div>


        <div class="w3-container w3-white" id="library">
            <h3 class='contTitle w3-row'>
                <div class='w3-left'>
                    <b>Book List</b>
                </div>
                <div class='w3-right'>
                    <button class='w3-btn w3-grey w3-round' onclick='library.bookCreationModal()'>+ Create Book</button>
                </div>
            </h3>
            <div id='libraryCont'>
                <table class='w3-table' style='width:100%'>
                    <thead>
                        <tr class='w3-text-grey'>
                            <td>COVER</td>
                            <td>TITLE</td>
                            <td>ISBN</td>
                            <td>AUTHOR</td>
                            <td>SUBJECT</td>
                            <td>RACK</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class='bluefont w3-tiny'>
                            <td>
                                <img src="Resources/Images/books.png" class="w3-margin w3-col" style="width:40px;">
                            </td>
                            <td>This is a sample title</td>
                            <td>12355584555</td>
                            <td>Ian Banda</td>
                            <td>ICT</td>
                            <td>5E</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modals -->
<!-- Check Book In/Out Modal -->
<div id="bookCheckinoutModal" class="w3-modal" action=''>
    <div class="w3-modal-content w3-light-gray">
        <div class="w3-container">
            <span onclick="document.getElementById('bookCheckinoutModal').style.display = 'none'"
                  class="w3-button w3-display-topright">&times;</span>
            <div class=""  id="epmodalCont">
                <div class="w3-text-grey">
                    <h1 id='modalCIOHeading' class="redfont" rel="">B</h1>
                    <b>
                        <h5 id="modalCIOBookTitle">Year 11 Science </h5>
                    </b>
                </div>
                <div class='w3-row'>
                    <div class="w3-half w3-left w3-margin w3-row w3-grey w3-round-xlarge w3-card">
                        <div class="w3-col w3-margin w3-small" src="{bits}/Resources/Images/search.png" style="">
                            New Custodian
                        </div>
                        <h5 class="w3-rest w3-margin-right w3-margin">
                            <input class="w3-input w3-round-xlarge w3-border-0 w3-padding" style="padding-left:30px;font-weight:bold" name="custodianSearchTF" onkeyup="search.liveSearch('custodianSearchTF')" type="text" placeholder="Search for Students, Teachers, Other Staff" />
                            <ul id="custodianSearchResults" class="w3-white w3-ul w3-card" style="position:absolute;width:80%;display:none">
                            </ul>
                        </h5>
                    </div>
                    <div class='w3-left'>
                        <div id='selectedCustodian' class='w3-padding w3-margin w3-light-green w3-round-large w3-tiny'>
                            Ian Bryan Banda
                        </div>
                    </div>
                </div>
                
                <div class="w3-white w3-margin w3-row" style="overflow: auto; max-height: 400px;">
                    <div class='w3-third'>
                        <img class="w3-col w3-margin" src="{bits}/Resources/Images/qr.png" alt='QR Code' style="width:100%" />
                    </div>
                    <div class='w3-twothird w3-padding'>
                        <div class='w3-half'>
                            <div class='w3-margin'>
                                <div class='w3-text-grey'>
                                    <b>Currently in Custody of</b>
                                    <div class='w3-text-blue w3-small'>
                                        <b>
                                            <a href="" id='currentBookCustodian' class='w3-text-blue'>Ian Bryan Banda</a>
                                        </b>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny w3-margin-top'>
                                    <b>ISBN</b>
                                    <div class='w3-text-blue'>
                                        <a href="" id='currentBookCustodian' class='w3-text-blue'>012456348655</a>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny'>
                                    <b>Rack</b>
                                    <div class='w3-text-blue'>
                                        <a href="" id='currentBookCustodian' class='w3-text-blue'>04</a>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny'>
                                    <b>Authors</b>
                                    <div class='w3-text-blue'>
                                        <a href="" id='currentBookCustodian' class='w3-text-blue'>Roal Dhal</a>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny'>
                                    <b>Genres</b>
                                    <div class='w3-text-blue'>
                                            <a href="" id='currentBookCustodian' class='w3-text-blue'>04</a>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny'>
                                    <b>Authors</b>
                                    <div class='w3-text-blue'>
                                            <a href="" id='currentBookCustodian' class='w3-text-blue'>04</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='w3-half'>
                            <div class='w3-margin'>
                                <div class='w3-text-grey'>
                                    <b>Book Trail</b>
                                    <div class='w3-text-blue w3-tiny w3-padding w3-light-blue w3-border w3-round-large' style='font-weight:normal'>
                                        <a href="" id='currentBookCustodian' class='w3-text-white'>Ian Bryan Banda</a>
                                        <div class='bluefont'>
                                            10/02/22 - 01/01/23
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w3-row w3-margin-bottom">
                    <button class="w3-right w3-btn w3-blue w3-margin" onclick="library.submitBookCheckinout()">Submit</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Create new Book Modal -->
<div id="bookCreationModal" class="w3-modal" action=''>
    <div class="w3-modal-content w3-light-gray">
        <div class="w3-container">
            <span onclick="document.getElementById('bookCreationModal').style.display = 'none'"
                  class="w3-button w3-display-topright">&times;</span>
            <div class=""  id="epmodalCont">
                <div class="w3-text-grey">
                    <h1 id='modalCIOHeading' class="redfont" rel="">B</h1>
                    <b>
                        <h5 id="modalCIOBookTitle">Create New Book </h5>
                    </b>
                </div>
                <div class='w3-row'>
                    <div class="w3-half w3-left w3-margin w3-row w3-white w3-round-xlarge w3-card">
                        <div class="w3-col w3-margin w3-small w3-text-grey" src="{bits}/Resources/Images/search.png" style="">
                            Book Title
                        </div>
                        <h5 class="w3-rest w3-margin-right w3-margin">
                            <input class="w3-input w3-round-xlarge w3-border-0 w3-padding" style="padding-left:30px;font-weight:bold" name="newBookTitle" onkeyup="search.liveSearch('custodianSearchTF')" type="text" placeholder="Search for Students, Teachers, Other Staff" />
                        </h5>
                    </div>
                    <div class='w3-left'>
                        <div id='selectedCustodian' class='w3-padding w3-margin w3-light-green w3-round-large w3-tiny'>
                            Ian Bryan Banda
                        </div>
                    </div>
                </div>
                
                <div class="w3-white w3-margin w3-row" style="overflow: auto; max-height: 400px;">
                    <div class='w3-third'>
                        <img class="w3-col w3-margin" src="{bits}/Resources/Images/qr.png" alt='QR Code' style="width:100%" />
                    </div>
                    <div class='w3-twothird w3-padding'>
                        <div class='w3-half'>
                            <div class='w3-margin'>
                                <div class='w3-text-grey'>
                                    <b>Currently in Custody of</b>
                                    <div class='w3-text-blue w3-small'>
                                        <b>
                                            <a href="" id='currentBookCustodian' class='w3-text-blue'>Ian Bryan Banda</a>
                                        </b>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny w3-margin-top'>
                                    <b>ISBN</b>
                                    <div class='w3-text-blue'>
                                        <a href="" id='currentBookCustodian' class='w3-text-blue'>012456348655</a>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny'>
                                    <b>Rack</b>
                                    <div class='w3-text-blue'>
                                        <a href="" id='currentBookCustodian' class='w3-text-blue'>04</a>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny'>
                                    <b>Authors</b>
                                    <div class='w3-text-blue'>
                                        <a href="" id='currentBookCustodian' class='w3-text-blue'>Roal Dhal</a>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny'>
                                    <b>Genres</b>
                                    <div class='w3-text-blue'>
                                            <a href="" id='currentBookCustodian' class='w3-text-blue'>04</a>
                                    </div>
                                </div>
                                <div class='w3-text-grey w3-tiny'>
                                    <b>Authors</b>
                                    <div class='w3-text-blue'>
                                            <a href="" id='currentBookCustodian' class='w3-text-blue'>04</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='w3-half'>
                            <div class='w3-margin'>
                                <div class='w3-text-grey'>
                                    <b>Book Trail</b>
                                    <div class='w3-text-blue w3-tiny w3-padding w3-light-blue w3-border w3-round-large' style='font-weight:normal'>
                                        <a href="" id='currentBookCustodian' class='w3-text-white'>Ian Bryan Banda</a>
                                        <div class='bluefont'>
                                            10/02/22 - 01/01/23
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w3-row w3-margin-bottom">
                    <button class="w3-right w3-btn w3-blue w3-margin" onclick="library.submitBookCheckinout()">Submit</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection