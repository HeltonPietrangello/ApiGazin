<div>
    <select class="form-control" name="level_id" id="level_id">
        <option v-for="level in levels" :value='level.id'>@{{level.level}}</option>
    </select>                        
</div>