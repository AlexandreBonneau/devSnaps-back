<?php

use Illuminate\Database\Seeder;

class SnapsTableSeeder extends Seeder {
    /**
     * Seed the Snap table with dummy Snaps.
     * Feel free to delete those.
     *
     * @return void
     */
    public function run() {
        $snaps = [];

        $snaps[] = [
            'title'       => 'Create a small Vuetify application',
            'slug'        => 'create-a-small-vuetify-application',
            'content'     => 'Well, this is a start, a pretty ugly one, but a start nonetheless.',
            'favorite'    => 1,
            'user_id'     => 2,
            'timesViewed' => 5,
            'timesEdited' => 0,
            'created_at'  => '2017-10-11 18:42:42',
            'updated_at'  => '2017-10-11 18:42:42',
        ];

        $snaps[] = [
            'title'       => 'How to set the width of the Vuetify v-container?',
            'slug'        => 'how-to-set-the-width-of-the-vuetify-v-container',
            'content'     => 'Following the [documentation](https://vuetifyjs.com/layout/grid), you need to set the `xs`, `sm`, `md` and `lg` component attributes, which will then be converted into CSS classes.',
            'favorite'    => 1,
            'user_id'     => 2,
            'timesViewed' => 1,
            'timesEdited' => 0,
            'created_at'  => '2017-10-11 19:31:47',
            'updated_at'  => '2017-10-11 20:04:54',
        ];

        $snaps[] = [
            'title'       => 'Testing the vue-markdown component syntax highlighting',
            'slug'        => 'testing-the-vue-markdown-component-syntax-highlighting',
            'content'     => 'Is this highlighted with the Js colors?:

```js
const foo = Object.keys(bar).length;
```',
            'favorite'    => 0,
            'user_id'     => 2,
            'timesViewed' => 1,
            'timesEdited' => 0,
            'created_at'  => '2017-10-11 20:26:35',
            'updated_at'  => '2017-10-11 20:26:35',
        ];

        $snaps[] = [
            'title'       => 'Testing the code highlight',
            'slug'        => 'testing-the-code-highlight',
            'content'     => 'This is the code to highlight:
```js
new AutoNumeric(\'#test\', {
    decimalPlacesRawValue     : 6,
    decimalPlacesShownOnBlur  : 3,
    decimalPlacesShownOnFocus : 4,
    emptyInputBehavior        : \'zero\',
    minimumValue              : -276,
    negativeBracketsTypeOnBlur: \'(,)\',
    showPositiveSign          : true,
    symbolWhenUnfocused       : \' ℃\',
    valuesToStrings           : {
        \'-273.15\': \'Absolute zero\',
        0        : \'Freezing\',
        22.5     : \'Warm\',
        30       : \'Hot\',
        100      : \'Boiling\',
        666      : \'Hellish\',
    },
    wheelStep                 : 2.5,
});

/**
 * Remove the post
 * @param {number} id
 */
        remove(id) {
// Remove the post from the server
axios.delete(`${this.api.baseUrl}/posts/${id}`)
    .then(response => {
        console.log(`Post ${id} deleted!`); //DEBUG

        // If that worked, also remove the post from the local object `this.posts`
        this.posts = this.posts.filter(obj => obj.id !== id);

        // And also update the search terms
        this.updateSearchTerms();
    
        // Show a confirmation for the user
        this._showSnackbar(`The post ${id} has been deleted.`, \'info\');
    },
          error => { // Response handler (rejected)
            const errorMessage = `Impossible to remove the post with id ${id}. Please try again in a moment.`;
            console.error(errorMessage, error); //DEBUG

            // Send the event to show a flash message
            this._showSnackbar(errorMessage, \'error\');
          });
},
```',
            'favorite'    => 1,
            'user_id'     => 2,
            'timesViewed' => 2,
            'timesEdited' => 3,
            'created_at'  => '2017-10-11 21:02:02',
            'updated_at'  => '2017-10-11 21:02:02',
        ];

        $snaps[] = [
            'title'       => 'Testing the html highlight!!',
            'slug'        => 'testing-the-html-highlight',
            'content'     => 'This should be some html code:
```html
<v-card-actions>
	<v-spacer></v-spacer>
	<v-btn flat
	       color="primary"
	       @click="update(post.id)"
	>Edit</v-btn>
	<v-btn flat
	       @click="displayRemoveModal(post.id, post.title)"
	>Remove</v-btn>
	<v-btn flat
	       @click="toggleFavorite(post.id)"
	>
		<v-icon
				:color="post.favorite?\'amber darken-1\':\'grey\'"
		>star</v-icon>
	</v-btn>
	<v-btn flat
	       :href="urlSearch(post.title)"
	       target="_blank"
	       title="Query the web with that question"
	>Search the web</v-btn>
</v-card-actions>
```',
            'favorite'    => 1,
            'user_id'     => 1,
            'timesViewed' => 4,
            'timesEdited' => 2,
            'created_at'  => '2017-10-11 21:10:44',
            'updated_at'  => '2017-10-11 23:32:28',
        ];

        $snaps[] = [
            'title'       => 'Testing html entities',
            'slug'        => 'testing-html-entities',
            'content'     => '```html
<h1>WebStorm</h1>
<p><br><b><IMG border=0 height=12 src="images/hg.gif" width=18 >
What is WebStorm? &#x00B7; &Alpha; </b><br><br>
</body>
```',
            'favorite'    => 0,
            'user_id'     => 1,
            'timesViewed' => 1,
            'timesEdited' => 0,
            'created_at'  => '2017-10-11 21:16:41',
            'updated_at'  => '2017-10-11 21:16:41',
        ];

        $snaps[] = [
            'title'       => 'Testing SCSS highlight!',
            'slug'        => 'testing-scss',
            'content'     => '```css
/**
	 * AciD theme for JavaScript, CSS and HTML
	 * Loosely based on the Okaidia theme
	 * @author Alexandre Bonneau <alexandre.bonneau@linuxfr.eu>
	 */
	code[class*="language-"],
	pre[class*="language-"] {
		color: #A9B7C6;
		background: none;
		text-shadow: 0 1px rgba(0, 0, 0, 0.3);
		font-family: \'DejaVu Sans Mono\', Consolas, Monaco, \'Andale Mono\', \'Ubuntu Mono\', monospace;
		font-weight: 400 !important; // I need to force that here since `_transitions.styl` has the code weight at 900!
		text-align: left;
		white-space: pre;
		word-spacing: normal;
		word-break: normal;
		word-wrap: normal;
		line-height: 1.5;

		-moz-tab-size: 4;
		-o-tab-size: 4;
		tab-size: 4;

		-webkit-hyphens: none;
		-moz-hyphens: none;
		-ms-hyphens: none;
		hyphens: none;
	}
```',
            'favorite'    => 1,
            'user_id'     => 2,
            'timesViewed' => 1,
            'timesEdited' => 2,
            'created_at'  => '2017-10-11 21:23:39',
            'updated_at'  => '2017-11-03 01:43:44',
        ];

        DB::table('snaps')->insert($snaps);
    }
}
