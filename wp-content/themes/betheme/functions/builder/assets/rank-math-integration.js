/**
 * RankMath custom fields integration class
 */

class RankMathCustomFields {

	/**
	 * Class constructor
	 */
	constructor() {
		this.init()
		this.hooks()
		this.events()

		const that = this;

		jQuery(document).on('mfn:builder:item:clone mfn:builder:item:add', function( $this, item ){
			that.init()
			that.events()
			rankMathEditor.refresh( 'content' )
		});
	}

	/**
	 * Init the custom fields
	 */
	init() {
		this.fields = this.getFields()
		this.getContent = this.getContent.bind( this )
	}

	/**
	 * Hook into Rank Math App eco-system
	 */
	hooks() {
		wp.hooks.addFilter( 'rank_math_content', 'rank-math', this.getContent, 11 )
	}

	/**
	 * Capture events from custom fields to refresh Rank Math analysis
	 */
	events() {
		jQuery( this.fields ).each( function( key, value ) {
			jQuery( value ).on(
				'keyup change',
				_.debounce( function() {
					rankMathEditor.refresh( 'content' )
				}, 500 )
			)
		} )
	}

	/**
	 * Get custom fields ids.
	 *
	 * @return {Array} Array of fields.
	 */
	getFields() {

		const fields = []
    const $builder = jQuery('#mfn-builder');

		jQuery( '.mfn-form-control.preview-title, .mfn-form-control.preview-subtitle, .mfn-form-control.preview-content', $builder ).each( function() {
			fields.push( jQuery(this) )
		} )

		return fields
	}

	/**
	 * Gather custom fields data for analysis
	 *
	 * @param {string} content Content to replce fields in.
	 *
	 * @return {string} Replaced content.
	 */
	getContent = function( content ) {

		// this.fields = this.getFields()

		jQuery( this.fields ).each( function( key, value ) {
      if( value ){
        content += ' '+ jQuery( value ).val()
      }
		} )

		return content
	}

}

jQuery( function() {
	setTimeout( function() {
		new RankMathCustomFields()
	}, 500 )
} )
