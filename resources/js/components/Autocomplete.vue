<template>
    <div class="autocomplete">
        <div
            class="autocomplete-input"
            @click="toggleVisible"
            v-text="selectedItem ? selectedItem[filterby] : ''"
        ></div>
        <div
            class="autocomplete-placeholder"
            v-if="selectedItem == null"
            v-text="placeholder"
        ></div>
        <button
            class="autocomplete-close"
            @click="selectedItem = null"
            v-if="selectedItem"
        >
            x
        </button>
        <div class="autocomplete-popover" v-show="visible">
            <input
                type="text"
                ref="input"
                v-model="query"
                @keydown.up="up"
                @keydown.down="down"
                @keydown.enter="selectItem"
                placeholder="Start Typing..."
            />
            <div class="autocomplete-options" ref="optionsList">
                <ul>
                    <li
                        v-for="(match, index) in matches"
                        :key="index"
                        :class="{ selected: selected == index }"
                        @click="itemClicked(index)"
                        v-text="match[filterby]"
                    ></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        items: {
            default: [],
            type: Array
        },
        filterby: {
            type: String
        },
        outputkey: {
            type: String,
            default: ""
        },
        placeholder: {
            default: "Select One...",
            type: String
        },
        shouldReset: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            itemHeight: 39,
            selectedItem: null,
            selected: 0,
            query: "",
            visible: false
        };
    },
    methods: {
        toggleVisible() {
            this.visible = !this.visible;
            setTimeout(() => {
                this.$refs.input.focus();
            }, 50);
        },
        itemClicked(index) {
            this.selected = index;
            this.selectItem();
        },
        selectItem() {
            if (!this.matches.length) {
                return;
            }
            this.selectedItem = this.matches[this.selected];
            this.visible = false;
            if (this.shouldReset) {
                this.query = "";
                this.selected = 0;
            }
            if (this.outputkey == "") {
                this.$emit(
                    "selected",
                    JSON.parse(JSON.stringify(this.selectedItem))
                );
            } else {
                this.$emit(
                    "selected",
                    JSON.parse(JSON.stringify(this.selectedItem))[
                        this.outputkey
                    ]
                );
            }
        },
        up() {
            if (this.selected == 0) {
                return;
            }
            this.selected -= 1;
            this.scrollToItem();
        },
        down() {
            if (this.selected >= this.matches.length - 1) {
                return;
            }
            this.selected += 1;
            this.scrollToItem();
        },
        scrollToItem() {
            this.$refs.optionsList.scrollTop =
                this.selected * this.itemHeight - this.itemHeight;
        }
    },
    computed: {
        matches() {
            this.$emit("change", this.query);
            if (this.query == "") {
                return [];
            }
            return this.items.filter(item =>
                item[this.filterby]
                    .toLowerCase()
                    .includes(this.query.toLowerCase())
            );
        }
    }
};
</script>

<style scoped>
/*
  Layout
*/
.autocomplete {
    width: 100%;
    position: relative;
}

.autocomplete-input {
    height: 40px;
    padding-left: 10px;
    padding-top: 10px;
}

.autocomplete-close {
    position: absolute;
    right: 2px;
    top: 4px;
}

.autocomplete-placeholder {
    position: absolute;
    top: 11px;
    left: 11px;
    pointer-events: none;
}

.autocomplete-popover {
    min-height: 50px;
    position: absolute;
    top: 46px;
    left: 0;
    right: 0;
    text-align: center;
}

.autocomplete-popover input {
    width: 95%;
    margin-top: 5px;
    height: 40px;
    padding-left: 8px;
}

.autocomplete-options {
    max-height: 150px;
    overflow-y: auto;
    margin-top: 5px;
}

.autocomplete-options ul {
    list-style-type: none;
    text-align: left;
    padding-left: 0;
}

.autocomplete-options ul li {
    padding: 10px;
    margin: 0 2px;
    margin-bottom: 2px;
}

/*
  Styling
*/
.autocomplete {
    font-family: sans-serif;
}

.autocomplete-input {
    border-radius: 4px;
    border: 2px solid lightgray;
    box-shadow: 0 0 10px #eceaea;
    font-size: 25px;
    cursor: text;
}

.autocomplete-close {
    background: none;
    border: none;
    font-size: 30px;
    color: lightgrey;
    cursor: pointer;
}

.autocomplete-placeholder {
    font-size: 25px;
    color: #d0d0d0;
}

.autocomplete-popover {
    border: 2px solid lightgray;
    background: #fff;
    border-radius: 4px;
}

.autocomplete-popover input {
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid lightgray;
}

.autocomplete-options ul li {
    border-bottom: 1px solid lightgray;
    cursor: pointer;
    color: white;
    background: #7b8a8b;
    border-radius: 10px;
}

.autocomplete-options ul li:first-child {
    border-top: 2px solid #d6d6d6;
}

.autocomplete-options ul li:not(.selected):hover {
    background: #6a7677;
}

.autocomplete-options ul li.selected {
    background: #2c3e50;
    font-weight: 600;
}
</style>