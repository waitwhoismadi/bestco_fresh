<div >
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="mange-tab" data-toggle="tab" href="#mange" role="tab" aria-controls="home" aria-selected="true">Управлять вакансиями</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="saved-tab" data-toggle="tab" href="#saved" role="tab" aria-controls="profile" aria-selected="false">Сохраненные вакансии</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#applied" role="tab" aria-controls="applied" aria-selected="false">Вакансии с вашими заявками</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="cadidates-tab" data-toggle="tab" href="#cadidates" role="tab" aria-controls="contact" aria-selected="false">Заявленные кандидаты</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="mange" role="tabpanel" aria-labelledby="mange-tab">

                <livewire:frontend.jobs.manage/>
         </div>
         <div class="tab-pane fade" id="saved" role="tabpanel" aria-labelledby="saved-tab">

                <livewire:frontend.jobs.saved/>
         </div>
         <div class="tab-pane fade" id="applied" role="tabpanel" aria-labelledby="applied-tab">

             <livewire:frontend.jobs.applied-jobs/>
         </div>
         <div class="tab-pane fade" id="cadidates" role="tabpanel" aria-labelledby="cadidates-tab">

             <livewire:frontend.jobs.applied-cadidates/>
         </div>
      </div>
</div>


