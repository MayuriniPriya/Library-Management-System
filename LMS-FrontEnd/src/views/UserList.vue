<template>
  <div>
    <AppBar />
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-card>
            <v-container>
              <v-row>
                <v-col cols="4">
                  <v-text-field
                    label="Search"
                    placeholder="search"
                    outlined
                  ></v-text-field>
                </v-col>
                <v-col cols="6"> </v-col>
                <v-col cols="2">
                  <v-btn
                   depressed
      color="primary"
                  >
                    Add
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
        </v-col>
        <v-col cols="12">
          <v-card>
            <v-card-title>
              User List
            </v-card-title>
            <v-data-table
              :headers="headers"
              :items="desserts"
              :search="search"
            ></v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import AppBar from "../components/AppBar";
export default {
  components: {
    AppBar
  }
};
</script>
