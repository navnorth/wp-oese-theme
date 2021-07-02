/**
 * BLOCK: oese-accordion-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */
//  Import CSS.
const {
  __
} = wp.i18n; // Import __() from wp.i18n

const {
  registerBlockType
} = wp.blocks; // Import registerBlockType() from wp.blocks

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */

registerBlockType('cgb/block-oese-accordion-block', {
  // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
  title: __('oese-accordion-block - CGB Block'),
  // Block title.
  icon: 'shield',
  // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
  category: 'common',
  // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
  keywords: [__('oese-accordion-block — CGB Block'), __('CGB Example'), __('create-guten-block')],

  /**
   * The edit function describes the structure of your block in the context of the editor.
   * This represents what the editor will render when the block is used.
   *
   * The "edit" property must be a valid function.
   *
   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
   *
   * @param {Object} props Props.
   * @returns {Mixed} JSX Component.
   */
  edit: props => {
    // Creates a <p class='wp-block-cgb-block-oese-accordion-block'></p>.
    return React.createElement("div", {
      className: props.className
    },
    
    React.createElement("p", null, "\u2014 Hello from the backend weh."),
    
    React.createElement("p", null, "CGB BLOCK: ", 
      React.createElement("code", null, "oese-accordion-block"), " is a new Gutenberg block"),
      React.createElement("p", null, "It was created via", ' ',
        React.createElement("code", null,
          React.createElement("a", {
              href: "https://github.com/ahmadawais/create-guten-block"
          }, "create-guten-block")
        ), "."
      )
    );
  },

  /**
   * The save function defines the way in which the different attributes should be combined
   * into the final markup, which is then serialized by Gutenberg into post_content.
   *
   * The "save" property must be specified and must be a valid function.
   *
   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
   *
   * @param {Object} props Props.
   * @returns {Mixed} JSX Frontend HTML.
   */
  save: props => {
    return /*#__PURE__*/React.createElement("div", {
      className: props.className
    }, /*#__PURE__*/React.createElement("p", null, "\u2014 Hello from the frontend."), /*#__PURE__*/React.createElement("p", null, "CGB BLOCK: ", /*#__PURE__*/React.createElement("code", null, "oese-accordion-block"), " is a new Gutenberg block."), /*#__PURE__*/React.createElement("p", null, "It was created via", ' ', /*#__PURE__*/React.createElement("code", null, /*#__PURE__*/React.createElement("a", {
      href: "https://github.com/ahmadawais/create-guten-block"
    }, "create-guten-block")), "."));
  }
});