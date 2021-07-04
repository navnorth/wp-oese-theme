/**
 * BLOCK: oese-accordion-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */
//  Import CSS.
const { __ } = wp.i18n; // Import __() from wp.i18n

const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks

const { InspectorControls, InnerBlocks, useBlockProps } = wp.blockEditor;
const { PanelBody } = wp.components;
const {
  CheckboxControl,
  RadioControl,
  TextControl,
  ToggleControl,
  SelectControl
} = wp.components;
const { withSelect } = wp.data;
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

registerBlockType("cgb/oese-accordion-block", {
  // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
  title: __("oese-accordion-block - CGB Block"),
  // Block title.
  icon: "shield",
  // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
  category: "oese-block-category",
  // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
  keywords: [
    __("oese-accordion-block — CGB Block"),
    __("CGB Example"),
    __("create-guten-block")
  ],
  attributes: {
    blockid: {
      type: "string"
    },
    accordionexpanded: {
      type: "boolean",
      default: true
    },
    accordiontitle: {
      type: "string"
    }
  },

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
  edit: (props) => {
    const attributes = props.attributes;
    const setAttributes = props.setAttributes; //SET BLOCK INSTANCE IDS

    let oeseblk_accordion_list = [];
    const blocks = wp.data.select("core/block-editor").getBlocks();
    blocks.map((val) => {
      if (val.name == "cgb/oese-accordion-block") {
        var uniq = "cb" + new Date().getTime();
        var cid = val.clientId;
        var attr = wp.data.select("core/block-editor").getBlockAttributes(cid);

        if (!attr.blockid) {
          wp.data.dispatch("core/block-editor").updateBlockAttributes(cid, {
            blockid: uniq,
            postsPerPage: 5,
            sortBy: "modified"
          });
        }
      } else if (val.name == "core/group") {
        val.innerBlocks.map((innval) => {
          if (innval.name == "cgb/oese-accordion-block") {
            var inuniq = "cb" + new Date().getTime();
            var incid = innval.clientId;
            var inattr = wp.data
              .select("core/block-editor")
              .getBlockAttributes(incid);
            console.log(
              "FOUND! -> " +
                innval.name +
                " -> " +
                innval.clientId +
                " -> " +
                inattr.blockid
            );

            if (!inattr.blockid) {
              wp.data
                .dispatch("core/block-editor")
                .updateBlockAttributes(incid, {
                  blockid: inuniq,
                  postsPerPage: 5,
                  sortBy: "modified"
                });
            }
          }
        });
      }
    });

    function accordiontitlechange(e) {
      setAttributes({
        accordiontitle: e.target.value
      });
    }

    const accordioncollapsetoggle = (e) => {
      setAttributes({
        accordionexpanded: e
      });
    };

    let arr = Array.apply(null, {
      length: 10
    }).map(Number.call, Number); // Creates a <p class='wp-block-cgb-block-oese-accordion-block'></p>.

    return /*#__PURE__*/ React.createElement(
      "div",
      {
        className: props.className
      },
      /*#__PURE__*/ React.createElement(
        InspectorControls,
        null,
        /*#__PURE__*/ React.createElement(
          PanelBody,
          {
            title: __("Accordion Block settings"),
            initialOpen: true
          },
          /*#__PURE__*/ React.createElement(
            "div",
            {
              class:
                "oer_curriculum_inspector_wrapper oer_curriculum_inspector_Postperpage"
            },
            /*#__PURE__*/ React.createElement(ToggleControl, {
              label: __("Expanded"),
              help: attributes.accordionexpanded
                ? __("Accordion content will be shown initially", "five")
                : __("Accordion content will be hidden initially", "five"),
              checked: !!attributes.accordionexpanded,
              onChange: (value) =>
                accordioncollapsetoggle(
                  attributes.accordionexpanded ? false : true
                )
            })
          )
        )
      ),
      /*#__PURE__*/ React.createElement(
        "div",
        {
          class: "oeseblk-" + attributes.blockid
        },
        /*#__PURE__*/ React.createElement(
          "div",
          {
            class: "oese-blk-accordion",
            id: "oese-blk-accordion-parent"
          },
          /*#__PURE__*/ React.createElement(
            "div",
            {
              class: "z-depth-0 bordered"
            },
            /*#__PURE__*/ React.createElement(
              "div",
              {
                class: "card-header oese-blk-accordion-header",
                id: "headingOne"
              },
              /*#__PURE__*/ React.createElement(
                "h5",
                {
                  class: "mb-0 oese-blk-accordion-title"
                },
                /*#__PURE__*/ React.createElement(
                  "a",
                  {
                    class: attributes.accordionexpanded
                      ? "btn btn-primary oese-blk-accordion-button"
                      : "btn btn-primary oese-blk-accordion-button collapsed",
                    "data-toggle": "collapse",
                    href: "#" + attributes.blockid + "-oeseCollapse1",
                    role: "button",
                    "aria-expanded": attributes.accordionexpanded,
                    "aria-controls": "oeseCollapse1"
                  },
                  /*#__PURE__*/ React.createElement("input", {
                    type: "text",
                    onChange: accordiontitlechange,
                    value: attributes.accordiontitle
                  })
                )
              )
            ),
            /*#__PURE__*/ React.createElement(
              "div",
              {
                id: attributes.blockid + "-oeseCollapse1",
                class: attributes.accordionexpanded
                  ? "oese-blk-accordion-content collapse show"
                  : "oese-blk-accordion-content collapse",
                "aria-labelledby": "headingOne",
                "data-parent": "#oese-blk-accordion-parent",
                tabindex: "0"
              },
              /*#__PURE__*/ React.createElement(
                "div",
                {
                  class: "card-body"
                },
                /*#__PURE__*/ React.createElement(InnerBlocks, {
                  allowedBlocks: ["core/image", "core/paragraph"],
                  templateInsertUpdatesSelection: false
                  /*templateLock="all"*/
                })
              )
            )
          )
        )
      )
    ); //main wrapper
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
   * @returns {Mixed} JSX Frontend HTML                      
                     .
   */
  save: (props) => {
    const attributes = props.attributes;
    return /*#__PURE__*/ React.createElement(
      "div",
      {
        className: props.className
      },
      /*#__PURE__*/ React.createElement(
        "div",
        {
          class: "oeseblk-" + attributes.blockid
        },
        /*#__PURE__*/ React.createElement(
          "div",
          {
            class: "oese-blk-accordion",
            id: "oese-blk-accordion-parent"
          },
          /*#__PURE__*/ React.createElement(
            "div",
            {
              class: "z-depth-0 bordered"
            },
            /*#__PURE__*/ React.createElement(
              "div",
              {
                class: "card-header oese-blk-accordion-header",
                id: "headingOne"
              },
              /*#__PURE__*/ React.createElement(
                "h5",
                {
                  class: "mb-0 oese-blk-accordion-title"
                },
                /*#__PURE__*/ React.createElement(
                  "a",
                  {
                    class: attributes.accordionexpanded
                      ? "btn btn-primary oese-blk-accordion-button"
                      : "btn btn-primary oese-blk-accordion-button collapsed",
                    "data-toggle": "collapse",
                    href: "#" + attributes.blockid + "-oeseCollapse1",
                    role: "button",
                    "aria-expanded": attributes.accordionexpanded,
                    "aria-controls": "oeseCollapse1",
                    "aria-label": attributes.accordiontitle
                  },
                  attributes.accordiontitle
                )
              )
            ),
            /*#__PURE__*/ React.createElement(
              "div",
              {
                id: attributes.blockid + "-oeseCollapse1",
                class: attributes.accordionexpanded
                  ? "oese-blk-accordion-content collapse show"
                  : "oese-blk-accordion-content collapse",
                "data-parent": "#oese-blk-accordion-parent",
                tabindex: "0"
              },
              /*#__PURE__*/ React.createElement(
                "div",
                {
                  class: "card-body"
                },
                /*#__PURE__*/ React.createElement(InnerBlocks.Content, null)
              )
            )
          )
        )
      )
    );
  }
});