@if (Gate::allows('laravel-inline-editor'))
    <inline-manager inline-template>
        <div id="inline-manager">
            <ul>
                <a v-on:click="applyChanges" title="Apply changes">
                    Save Changes
                </a>
            </ul>
        </div>
    </inline-manager>
@endif