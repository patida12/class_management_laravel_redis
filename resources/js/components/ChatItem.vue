<template>
<div>
    <div v-if="$root.currentUserLogin.id != message.user.id" class="message" :class="{'is-current-user': $root.currentUserLogin.id === message.user.id}">
        <div class="message-item user-name">
			{{ message.user.username}}
		</div>
        <div class="container">
  <p>{{ message.message }}</p>
  <span class="time-right">{{ createdAt.split(' ')[1] }}</span>
</div>
	</div>
    <div v-if="$root.currentUserLogin.id === message.user.id" class="message" :class="{'is-current-user': $root.currentUserLogin.id === message.user.id}">
        <div class="message-item user-name">
			{{ message.user.username}}
		</div>
        <div class="container darker">
  <p>{{ message.message}}</p>
  <span class="time-left">{{ createdAt.split(' ')[1] }}</span>
</div>

	</div>
</div>

</template>

<script>
	export default {
        props: ['message'],
		computed: {
			createdAt() {
				const date = new Date(this.message.created_at)
				return date.toLocaleString()
			}
		}
    }
</script>

<style lang="scss" scoped>
	.message {
		color: black;
        font-size: larger;
	}
	.is-current-user {
		color:white;
	}

    /* Chat containers */
    .container {
    background-color: rgb(219, 214, 214);
    border-radius: 20px;
    padding: 5px;
    margin: 2px 0;
    max-width: 400px;
    }

    /* Darker chat container */
    .darker {
    background-color: rgb(33, 132, 224);
    margin-left: 400px;
    }

    /* Clear floats */
    .container::after {
    content: "";
    clear: both;
    display: table;
    }

    /* Style time text */
    .time-right {
    font-size: smaller;
    float: right;
    color: rgb(102, 101, 101);
    }

    /* Style time text */
    .time-left {
    font-size: smaller;
    float: left;
    color: rgb(212, 209, 209);
    }
</style>
